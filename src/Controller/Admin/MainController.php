<?php

namespace App\Controller\Admin;

use App\Repository\HoraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/admin', name: 'admin_')]
    public function index(HoraireRepository $horaireRepository): Response
    {
        return $this->render('Admin/index.html.twig', [
            'horaires' => $horaireRepository -> findAll(),
        ]);
    }
    #[Route('/admin/openHours', name: 'admin_openHours')]
    public function showOpenHours(HoraireRepository $horaireRepository): Response
    {
        return $this->render('Admin/openHours.html.twig', [
            'horaires' => $horaireRepository -> findAll(),
        ]);
    }
}
