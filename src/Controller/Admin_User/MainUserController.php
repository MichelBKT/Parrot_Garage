<?php

namespace App\Controller\Admin_User;

use App\Entity\Annonce;
use App\Entity\Caracteristique;
use App\Entity\Voiture;
use App\Entity\VoitureCaracteristique;
use App\Repository\AnnonceRepository;
use App\Repository\AvisClientRepository;
use App\Repository\HoraireRepository;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
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
    public function manageAdvert(HoraireRepository $horaireRepository, AnnonceRepository $annonceRepository): Response
    {
        return $this->render('Admin_user/advertManager.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'annonces' => $annonceRepository->findAll(),
        ]);
    }

    #[Route('/user/car/new', name: 'user_car_new')]
    public function createCar(HoraireRepository $horaireRepository, Request $request, EntityManagerInterface $entityManager, PictureService $pictureService): Response
    {
        $voiture = new Voiture();

        $form = $this->createForm(CarType::class, $voiture);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            //on récupère l'image
            $photos = $form->get('photo')->getData();
            foreach ($photos as $photo){
                // on définit le dossier de destination
                $folder = 'voiture';

                // on appelle le service d'ajout
                $file = $pictureService->add($photo, $folder, 350, 300);
                $voiture->setPhoto($file);
            }
          $entityManager->persist($voiture);
          $entityManager->flush();
          $this->addFlash('notice', 'Création voiture effectuée!');
          return $this->redirectToRoute('user_car_caracteristics_new');
        }
          return $this->render('Admin_user/addCarForm.html.twig',[
            'horaires'=>$horaireRepository->findAll(),
            'formView' => $form->createView(),
        ]);

    }

    #[Route('/user/car/edit/{id}', name: 'user_car_edit')]
    public function editCar(HoraireRepository $horaireRepository, Request $request, EntityManagerInterface $entityManager, Voiture $voiture, PictureService $pictureService): Response
    {
        $form= $this->createForm(CarType::class, $voiture);
        $form->handleRequest($request);
        $voiture = $form->getData();
        if ($form->isSubmitted() && $form->isValid()){
            //on récupère l'image
            $photos = $form->get('photo')->getData();
            foreach ($photos as $photo){
                // on définit le dossier de destination
                $folder = 'voiture';

                // on appelle le service d'ajout
                $file = $pictureService->add($photo, $folder, 350, 300);
                $voiture->setPhoto($file);
            }

            $entityManager->persist($voiture);
            $entityManager->flush();

            $this->addFlash('notice', 'La modification a bien été prise en compte');
        }
        return $this->render('Admin_user/addCarForm.html.twig', [
            'horaires'=> $horaireRepository->findAll(),
            'voitures'=> $voiture,
            'formView' => $form->createView()
        ]);
    }

    #[Route('/user/car/caracteristics/new', name: 'user_car_caracteristics_new')]
    public function createCaracteristics(HoraireRepository $horaireRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $caracteristique = new Caracteristique();
        $form = $this->createForm(CaracteristiqueType::class, $caracteristique);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
          $entityManager->persist($caracteristique);
          $entityManager->flush();
          $this->addFlash('notice', 'Création caractéristiques effectuée!');
          return $this->redirectToRoute('user_car_link_new');
        }
          return $this->render('Admin_user/addCaracteristiqueForm.html.twig',[
            'horaires'=>$horaireRepository->findAll(),
            'formView' => $form->createView(),
        ]);

    }

    #[Route('/user/car/caracteristics/edit/{id}', name: 'user_car_caracteristics_edit')]
    public function editCaracteristics(HoraireRepository $horaireRepository, Request $request, EntityManagerInterface $entityManager,Caracteristique $caracteristique, Voiture $voiture): Response
    {
        $form= $this->createForm(CaracteristiqueType::class, $caracteristique);
        $form->handleRequest($request);
        $caracteristique = $form->getData();
        if ($form->isSubmitted() && $form->isValid()){
            
            $entityManager->persist($caracteristique);
            $entityManager->flush();

            $this->addFlash('notice', 'La modification a bien été prise en compte');
        }
        return $this->render('Admin_user/addCaracteristiqueForm.html.twig', [
            'horaires'=> $horaireRepository->findAll(),
            'voitures' => $voiture,
            'caracteristiques'=> $caracteristique,
            'formView' => $form->createView()
        ]);
    } 

    #[Route('/user/car/link/new', name: 'user_car_link_new')]
    public function createLink(HoraireRepository $horaireRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $link = new VoitureCaracteristique();
        $form = $this->createForm(LinkCarType::class, $link);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
          $entityManager->persist($link);
          $entityManager->flush();
          $this->addFlash('notice', 'Lien voiture/caractéristiques créé!');
          return $this->redirectToRoute('user_ad_new');
        }
          return $this->render('Admin_user/addLinkForm.html.twig',[
            'horaires'=>$horaireRepository->findAll(),
            'formView' => $form->createView(),
        ]);

    }
            
    #[Route('/user/ad/new', name: 'user_ad_new')]
    public function createAdvert(HoraireRepository $horaireRepository, Request $request, EntityManagerInterface $entityManager): Response
    { 
        $annonce = new Annonce();

        $form = $this->createForm(AdvertType::class, $annonce);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
          $entityManager->persist($annonce);
          $entityManager->flush();
          return $this->redirectToRoute('app_user');  
        }
        return $this->render('Admin_user/addAdvertForm.html.twig',[
            'horaires'=>$horaireRepository->findAll(),
            'formView' => $form->createView(),
        ]);

    }

    #[Route('/user/car/ad/edit/{id}', name: 'user_car_ad_edit')]
    public function editAdvert(HoraireRepository $horaireRepository, Request $request, EntityManagerInterface $entityManager,Annonce $annonce, Voiture $voiture): Response
    {
        $form= $this->createForm(AdvertType::class, $annonce);
        $form->handleRequest($request);
        $annonce = $form->getData();
        if ($form->isSubmitted() && $form->isValid()){
            
            $entityManager->persist($annonce);
            $entityManager->flush();

            $this->addFlash('notice', 'La modification a bien été prise en compte');

        }
        return $this->render('Admin_user/addAdvertForm.html.twig', [
            'horaires'=> $horaireRepository->findAll(),
            'voitures'=> $voiture,
            'annnonces'=> $annonce,
            'formView' => $form->createView()
        ]);
    } 
    #[Route('/user/comments', name: 'user_comments')]
    public function showComments(HoraireRepository $horaireRepository, AvisClientRepository $avisClientRepository): Response
    {
        return $this->render('Admin_user/comment.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'avisClients' => $avisClientRepository->findAll(),
        ]);
    }
}
