<?php

namespace App\Controller\Admin;

use App\Entity\Entretien;
use App\Entity\Service;
use App\Repository\EntretienRepository;
use App\Repository\HoraireRepository;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    #[Route('/admin/servicemanager/delete/{id}', name: 'app_service_manager_delete', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function delete(HoraireRepository $horaireRepository, ServiceRepository $serviceRepository, EntretienRepository $entretienRepository, EntityManagerInterface $manager, Service $service): Response
        {
            $form = $this->createForm(ServiceType::class, $service);
            $manager->remove($service);
            $manager->flush();
            $this->addFlash('notice', 'Suppression effectuée avec succès!');

            return $this->render('Admin/servicemanager.html.twig', [
                'horaires' => $horaireRepository->findAll(),
                'services' => $serviceRepository->findAll(),
                'entretiens' => $entretienRepository->findAll(),
                'form' => $form->createView()
            ]);
        }
    #[Route('/admin/servicemanager/add', name: 'app_service_manager_add')]
    public function add(HoraireRepository $horaireRepository, ServiceRepository $serviceRepository,Request $request, EntityManagerInterface $manager): Response
        {
            $service = new Service();
            $form = $this->createForm(ServiceType::class, $service);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                $service = $form->getData();
                
                $manager->persist($service);
                $manager->flush();
                $this->addFlash('notice', 'Ajout effectué avec succès!');
                return $this->redirectToRoute('app_service_manager');
            }
            return $this->render('Admin/serviceAdd.html.twig', [
                'horaires' => $horaireRepository->findAll(),
                'services' => $serviceRepository->findAll(),
                'form' => $form->createView()
            ]);
        }
    #[Route('/admin/entretienmanager/delete/{id}', name: 'app_entretien_manager_delete', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function deleteEnt(HoraireRepository $horaireRepository, ServiceRepository $serviceRepository, EntretienRepository $entretienRepository, EntityManagerInterface $manager, Entretien $entretien): Response
        {
            $form = $this->createForm(EntretienType::class, $entretien);
            $manager->remove($entretien);
            $manager->flush();
            $this->addFlash('notice', 'Suppression effectuée avec succès!');

            return $this->render('Admin/servicemanager.html.twig', [
                'horaires' => $horaireRepository->findAll(),
                'services' => $serviceRepository->findAll(),
                'entretiens' => $entretienRepository->findAll(),
                'form' => $form->createView()
            ]);
        }
    #[Route('/admin/entretienmanager/add', name: 'app_entretien_manager_add')]
    public function addEnt(HoraireRepository $horaireRepository, EntretienRepository $entretienRepository, Request $request, EntityManagerInterface $manager): Response
        {
            $entretien = new Entretien();
            $form = $this->createForm(EntretienType::class, $entretien);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                $entretien = $form->getData();
                
                $manager->persist($entretien);
                $manager->flush();
                return $this->redirectToRoute('app_service_manager');
                $this->addFlash('notice', 'Ajout effectué avec succès!');

            }
            return $this->render('Admin/serviceAdd.html.twig', [
                'horaires' => $horaireRepository->findAll(),
                'entretiens' => $entretienRepository->findAll(),
                'form' => $form->createView()
            ]);
        }
    }
