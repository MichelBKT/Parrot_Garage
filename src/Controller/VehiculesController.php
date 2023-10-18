<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Repository\AnnonceRepository;
use App\Repository\HoraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class VehiculesController extends AbstractController
{
    #[Route('/vehicules/details/all', name: 'app_vehicules/details/all')]
    public function index(HoraireRepository $horaireRepository,  AnnonceRepository $annonceRepository): Response
    {
        return $this->render('vehicules/vehicules.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'annonces' => $annonceRepository->findAll(),

        ]);

    }

    #[Route('/vehicules/details/{id}', name: 'app_vehicules_details', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function showDetails(Annonce $annonce, HoraireRepository $horaireRepository): Response
    {
         return $this->render('vehicules/vehicules_details.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'annonce' => $annonce,
            
        ]); 
    }
}
