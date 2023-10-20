<?php

namespace App\Controller;

use App\Repository\HoraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AproposController extends AbstractController
{
    #[Route('/condition/utilisation', name: 'app_condition_utilisation')]
    public function index(HoraireRepository $horaireRepository): Response
    {
        return $this->render('A_propos/condUtilisation.html.twig', [
            'horaires' => $horaireRepository->findAll()

        ]);
    }
    #[Route('/mentionleg', name: 'app_mentions_legales')]
    public function mentionleg(HoraireRepository $horaireRepository): Response
    {
        return $this->render('A_propos/mentionsLegales.html.twig', [
            'horaires' => $horaireRepository->findAll()

        ]);
    }
    #[Route('/politiqueconf', name: 'app_politique_confidentialite')]
    public function politiqueconf(HoraireRepository $horaireRepository): Response
    {
        return $this->render('A_propos/polconf.html.twig', [
            'horaires' => $horaireRepository->findAll()

        ]);
    }
}

