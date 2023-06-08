<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Repository\AnnonceRepository;
use App\Repository\HoraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    #[Route('/form', name: 'app_form')]
    public function index(HoraireRepository $horaireRepository, AnnonceRepository $annonceRepository): Response
    {
        return $this->render('form/contact.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'annonces' => $annonceRepository->findAll()
        ]);
    }
    #[Route('/form/{id}', name: 'app_form_vehicule', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function showTitle(HoraireRepository $horaireRepository, Annonce $annonce): Response
    {
        return $this->render('form/contact.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'annonce' => $annonce
        ]);
    }
}
