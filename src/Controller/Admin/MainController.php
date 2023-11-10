<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\Horaire;
use App\Repository\ContactRepository;
use App\Repository\EntretienRepository;
use App\Repository\HoraireRepository;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    #[Route('/admin/read/{id}', name: 'admin_read', methods: ['GET', 'POST'])]
    public function read(HoraireRepository $horaireRepository, ContactRepository $contactRepository, Contact $contact, EntityManagerInterface $manager): Response
    {
        $contact->setLu(true);
        $manager->persist($contact);
        $manager->flush();

        return $this->render('Admin/index.html.twig', [
            'horaires' => $horaireRepository -> findAll(),
            'contactReading' => $contactRepository -> findBy(['Lu' => '1']),
            'contact' => $contactRepository -> findAll(),
        ]);
    }
    #[Route('/admin/unread/{id}', name: 'admin_unread', methods: ['GET', 'POST'])]
    public function unread(HoraireRepository $horaireRepository, ContactRepository $contactRepository, Contact $contact, EntityManagerInterface $manager): Response
    {
        $contact->setLu(false);
        $manager->persist($contact);
        $manager->flush();

        return $this->render('Admin/index.html.twig', [
            'horaires' => $horaireRepository -> findAll(),
            'contactReading' => $contactRepository -> findBy(['Lu' => '1']),
            'contact' => $contactRepository -> findAll(),
        ]);
    }
    #[Route('/admin/contact/delete/{id}', name: 'admin_contactDelete', methods: ['GET', 'POST'])]
    public function contactDelete(HoraireRepository $horaireRepository, ContactRepository $contactRepository, Contact $contact, EntityManagerInterface $manager): Response
    {
        $manager->remove($contact);
        $manager->flush();

        return $this->render('Admin/index.html.twig', [
            'horaires' => $horaireRepository -> findAll(),
            'contactReading' => $contactRepository -> findBy(['Lu' => '1']),
            'contact' => $contactRepository -> findAll(),
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
    #[Route('/admin/openHours/modify/{id}', name: 'admin_modifyOpenHours_selected', methods: ['GET', 'POST'])]
    public function edit(Horaire $horaire, HoraireRepository $horaireRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OpenHoursType::class, $horaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $horaire = $form->getData();

            $entityManager->persist($horaire);
            $entityManager->flush();

            $this->addFlash('notice', 'La modification de l\'horaire a bien été prise en compte');
        }
        

        return $this->render('Admin/editopenhours.html.twig', [
            'horaires'=>$horaireRepository->findAll(),
            'horaire'=>$horaire,
            'form' => $form->createView()
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
