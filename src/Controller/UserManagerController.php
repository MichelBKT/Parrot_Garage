<?php

namespace App\Controller;

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
          return $this->redirectToRoute('app_user');  
        }
        return $this->render('Admin/adduserform.html.twig',[
            'horaires'=>$horaireRepository->findAll(),
            'formView' => $form->createView(),
        ]);
    }

}
