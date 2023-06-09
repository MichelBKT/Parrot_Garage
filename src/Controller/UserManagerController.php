<?php

namespace App\Controller;

use App\Repository\HoraireRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserManagerController extends AbstractController
{
    #[Route('/admin/usermanager', name: 'app_usermanager')]
    public function index(HoraireRepository $horaireRepository, UserRepository $userRepository): Response
    {
        return $this->render('Admin/usermanager.html.twig', [
            'horaires' => $horaireRepository -> findAll(),
            'users' => $userRepository -> findAll()
        ]);
    }
}
