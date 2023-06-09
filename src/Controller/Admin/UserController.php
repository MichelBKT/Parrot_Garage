<?php

namespace App\Controller\Admin;

use App\Repository\HoraireRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/admin/user', name: 'app_user')]
    public function index(HoraireRepository $horaireRepository, UserRepository $userRepository): Response
    {
        return $this->render('Admin/userlist.html.twig', [
            'horaires' => $horaireRepository -> findAll(),
            'users' => $userRepository -> findAll()
        ]);
    }
}
