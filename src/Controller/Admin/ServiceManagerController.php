<?php

namespace App\Controller\Admin;

use App\Repository\EntretienRepository;
use App\Repository\HoraireRepository;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceManagerController extends AbstractController
{
    #[Route('/admin/servicemanager', name: 'app_service_manager')]
    public function index(HoraireRepository $horaireRepository, ServiceRepository $serviceRepository, EntretienRepository $entretienRepository): Response
    {
        return $this->render('Admin/servicemanager.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'services' => $serviceRepository->findAll(),
            'entretiens' => $entretienRepository->findAll(),
        ]);
    }
}
