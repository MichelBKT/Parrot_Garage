<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\HoraireRepository;
use App\Repository\UserRepository;
use App\Controller\Admin\AdduserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserManagerController extends AbstractController
{
    #[Route('/admin/usermanager', name: 'app_usermanager')]
    public function index(HoraireRepository $horaireRepository, UserRepository $userRepository): Response
    {
        return $this->render('Admin/usermanager.html.twig', [
            'horaires' => $horaireRepository -> findAll(),
            'users' => $userRepository -> findAll()
        ]);
    }
    #[Route('/admin/user/add', name: 'app_user_add')]
    public function create(HoraireRepository $horaireRepository,Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();

        $form = $this->createForm(AdduserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
                );
          $entityManager->persist($user);
          $entityManager->flush();
          $this->addFlash('notice', 'Ajout effectué avec succès!');
          return $this->redirectToRoute('app_usermanager');  
        }
        return $this->render('Admin/adduserform.html.twig',[
            'horaires'=>$horaireRepository->findAll(),
            'formView' => $form->createView(),
        ]);
    }
    #[Route('/admin/user/delete/{id}', name: 'app_user_delete', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function deleteUser(HoraireRepository $horaireRepository, User $user, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $form= $this->createForm(AdduserType::class, $user);
        $entityManager->remove($user);
        $entityManager->flush();
        $this->addFlash('notice', 'Suppression effectuée avec succès!');

        return $this->render('Admin/usermanager.html.twig',[
            'horaires'=> $horaireRepository->findAll(),
            'users' => $userRepository->findAll(),
            'formView' => $form->createView(),
        ]);
    }
    #[Route('/admin/user/modify/{id}', name: 'admin_userModify_selected', methods: ['GET', 'POST'])]
    public function edit(HoraireRepository $horaireRepository, User $user, Request $request,UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserUpdateType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
                );
            $user = $form->getData();

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('notice', 'La modification de l\'utilisateur a bien été prise en compte');
        }
        

        return $this->render('Admin/editUser.html.twig', [
            'horaires'=>$horaireRepository->findAll(),
            'users' => $user,
            'form' => $form->createView()
        ]);
    }
}
