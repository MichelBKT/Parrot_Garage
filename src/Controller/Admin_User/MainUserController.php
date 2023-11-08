<?php

namespace App\Controller\Admin_User;

use App\Entity\Annonce;
use App\Entity\Avisclient;
use App\Form\EditavisType;
use App\Repository\AnnonceRepository;
use App\Repository\AvisclientRepository;
use App\Repository\HoraireRepository;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainUserController extends AbstractController
{
    #[Route('/user', name: 'user_')]
    public function index(HoraireRepository $horaireRepository): Response
    {
        return $this->render('Admin_user/index.html.twig', [
            'horaires' => $horaireRepository->findAll(),
        ]);
    }

    #[Route('/user/ad', name: 'user_ad')]
    public function showAdvert(HoraireRepository $horaireRepository, AnnonceRepository $annonceRepository): Response
    {
        return $this->render('Admin_user/advertList.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'annonces' => $annonceRepository->findAll(),
        ]);
    }

    #[Route('/user/ad/manager', name: 'user_ad_manager')]
    public function manageAdvert(HoraireRepository $horaireRepository, AnnonceRepository $annonceRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $annonceRepository->paginationQuery(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('Admin_user/advertManager.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'annonces' => $annonceRepository->findAll(),
            'pagination' => $pagination
        ]);
    }

    #[Route('/user/ad/new', name: 'user_ad_new')]
    public function createAdvert(HoraireRepository $horaireRepository, Request $request, EntityManagerInterface $entityManager, PictureService $pictureService): Response
    { 
        $annonce = new Annonce();

        $form = $this->createForm(AdvertType::class, $annonce);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
                //on récupère l'image
                $photos = $form->get('photo')->getData();
                foreach ($photos as $photo){
                    // on définit le dossier de destination
                    $folder = 'voiture';
    
                    // on appelle le service d'ajout
                    $file = $pictureService->add($photo, $folder, 350, 300);
                    $annonce->setPhoto($file);
                }
          $entityManager->persist($annonce);
          $entityManager->flush();
          $this->addFlash('notice', 'Annonce ajoutée avec succès!'); 
        }
        return $this->render('Admin_user/addAdvertForm.html.twig',[
            'horaires'=>$horaireRepository->findAll(),
            'formView' => $form->createView(),
        ]);
    }
    

    #[Route('/user/car/ad/edit/{id}', name: 'user_car_ad_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function editAdvert(HoraireRepository $horaireRepository, Request $request, EntityManagerInterface $entityManager,Annonce $annonce, PictureService $pictureService): Response
    {
        $form= $this->createForm(AdvertType::class, $annonce);
        $form->handleRequest($request);
        $annonce = $form->getData();
        if ($form->isSubmitted() && $form->isValid()){
            //on récupère l'image
            $photos = $form->get('photo')->getData();
            foreach ($photos as $photo){
                // on définit le dossier de destination
                $folder = 'voiture';

                // on appelle le service d'ajout
                $file = $pictureService->add($photo, $folder, 350, 300);
                $annonce->setPhoto($file);
            }
            $entityManager->persist($annonce);
            $entityManager->flush();

            $this->addFlash('notice', 'La modification a bien été prise en compte');

        }
        return $this->render('Admin_user/addAdvertForm.html.twig', [
            'horaires'=> $horaireRepository->findAll(),
            'annonces'=> $annonce,
            'formView' => $form->createView()
        ]);
    } 
    #[Route('/user/car/ad/delete/{id}', name: 'user_car_ad_delete', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function deleteAdvert(HoraireRepository $horaireRepository, AnnonceRepository $annonceRepository, Request $request, EntityManagerInterface $entityManager,Annonce $annonce, PaginatorInterface $paginator): Response
    {
        $form= $this->createForm(AdvertType::class, $annonce);
        $entityManager->remove($annonce);
        $entityManager->flush();
        $this->addFlash('notice', 'Suppression effectuée avec succès!');

        $pagination = $paginator->paginate(
            $annonceRepository->paginationQuery(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('Admin_user/advertManager.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'annonces' => $annonceRepository->findAll(),
            'pagination' => $pagination,
            'formView' => $form->createView()
        ]);
    } 
    #[Route('/user/comments', name: 'user_comments')]
    public function showComments(HoraireRepository $horaireRepository, AvisclientRepository $avisClientRepository): Response
    {
        return $this->render('Admin_user/comment.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'avisClients' => $avisClientRepository->findAll(),
        ]);
    }
    #[Route('/user/comments/manager', name: 'user_comments_manager')]
    public function manageComments(HoraireRepository $horaireRepository, AvisclientRepository $avisClientRepository): Response
    {
        return $this->render('Admin_user/modifyComments.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'avisClients' => $avisClientRepository->findAll(),
        ]);
    }
    #[Route('/user/comments/edit/{id}', name: 'user_comments_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function editComments(HoraireRepository $horaireRepository, Request $request, EntityManagerInterface $entityManager,Avisclient $avisclient ): Response
    {
        $form= $this->createForm(EditavisType::class, $avisclient);
        $form->handleRequest($request);
        $avisclient = $form->getData();
        if ($form->isSubmitted() && $form->isValid()){
            
            $entityManager->persist($avisclient);
            $entityManager->flush();

            $this->addFlash('notice', 'La modification a bien été prise en compte');

        }
        return $this->render('Admin_user/addComment.html.twig', [
            'horaires'=> $horaireRepository->findAll(),
            'avisclients'=> $avisclient,
            'formView' => $form->createView()
        ]);
    } 
}

