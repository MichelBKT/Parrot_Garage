<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Avisclient;
use App\Form\AvisType;
use App\Repository\AnnonceRepository;
use App\Repository\AvisclientRepository;
use App\Repository\HoraireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Url;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    
    public function index(HoraireRepository $horaireRepository, AvisclientRepository $avisClientRepository, AnnonceRepository $annonceRepository): Response
    {
        return $this->render('home/home.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'avisClients' => $avisClientRepository->findAll(),
            'annonces' => $annonceRepository->findAll(),
        ]);


        
    }
    #[Route('/comment/new', name: 'app_comment_new')]
    
    public function addComment(HoraireRepository $horaireRepository, Request $request, EntityManagerInterface $em ): Response
    {
        $avis = new AvisClient();
        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
          $em->persist($avis);
          $em->flush();
          $this->addFlash('notice', 'Votre commentaire a bien été envoyé!'); 
        }
        return $this->render('Form/comment.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'formView' => $form->createView(),
        ]);
    }
}

