<?php

namespace App\Controller\Admin;

use App\Repository\EntretienRepository;
use App\Repository\HoraireRepository;
use App\Repository\ServiceRepository;
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

    #[Route('/admin/openHours/modify', name: 'admin_modifyOpenHours')]
    public function openHoursManager(HoraireRepository $horaireRepository): Response
    {
        return $this->render('Admin/modifyopenhours.html.twig', [
            'horaires' => $horaireRepository -> findAll(),
        ]);
    }
    #[Route('/admin/services', name: 'admin_services')]
    public function showServices(HoraireRepository $horaireRepository, ServiceRepository $serviceRepository, EntretienRepository $entretienRepository): Response
    {
        return $this->render('Admin/services.html.twig', [
            'horaires' => $horaireRepository -> findAll(),
            'services' => $serviceRepository -> findAll(),
            'entretiens' => $entretienRepository -> findAll(),
        ]);
    }
}
