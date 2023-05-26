<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntretiensServicesController extends AbstractController
{
    #[Route('/entretiens/services', name: 'app_entretiens_services')]
    public function index(): Response
    {
        return $this->render('entretiens_services/index.html.twig', [
            'controller_name' => 'EntretiensServicesController',
        ]);
    }
}
