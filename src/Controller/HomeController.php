<?php

namespace App\Controller;

use App\Repository\AvisClientRepository;
use App\Repository\HoraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    
    public function index(HoraireRepository $horaireRepository, AvisClientRepository $avisClientRepository): Response
    {
        return $this->render('home/home.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'avisClients' => $avisClientRepository->findAll()
        ]);
    }

}

