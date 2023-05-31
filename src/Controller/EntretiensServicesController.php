<?php

namespace App\Controller;

use App\Repository\HoraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntretiensServicesController extends AbstractController
{
    #[Route('/entretiens/services', name: 'app_entretiens_services')]

    public function showOpenHours(HoraireRepository $horaireRepository): Response
    {
        return $this->render('entretiens_services/entretienservices.html.twig', [
            'horaires' => $horaireRepository->findAll()
        ]);
    }
}
