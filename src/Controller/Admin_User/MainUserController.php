<?php

namespace App\Controller\Admin_User;

use App\Repository\AnnonceRepository;
use App\Repository\AvisClientRepository;
use App\Repository\HoraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainUserController extends AbstractController
{
    #[Route('/user', name: 'user_')]
    public function index(HoraireRepository $horaireRepository): Response
    {
        return $this->render('Admin_user/index.html.twig', [
            'horaires' => $horaireRepository->findAll(),
        ]);
    }
    #[Route('/user/ad', name: 'user_ad')]
    public function showAdvert(HoraireRepository $horaireRepository, AnnonceRepository $annonceRepository): Response
    {
        return $this->render('Admin_user/advertList.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'annonces' => $annonceRepository->findAll(),
        ]);
    }
    #[Route('/user/comments', name: 'user_comments')]
    public function showComments(HoraireRepository $horaireRepository, AvisClientRepository $avisClientRepository): Response
    {
        return $this->render('Admin_user/comment.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'avisClients' => $avisClientRepository->findAll(),
        ]);
    }
}
