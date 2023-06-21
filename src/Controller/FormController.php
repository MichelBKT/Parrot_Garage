<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\AnnonceRepository;
use App\Repository\ContactRepository;
use App\Repository\HoraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;

class FormController extends AbstractController
{
    #[Route('/form', name: 'app_form', methods: ['GET', 'POST'])]
    public function sendEmailAction(HoraireRepository $horaireRepository, AnnonceRepository $annonceRepository, Request $request, ContactRepository $contactRepository, MailerInterface $mailer): Response
    {
        $contact = new Contact();

        $form= $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $contactRepository->save($contact, true);
            $adress = $contact->getEmail();
            $subject = $contact->getObjet();
            $message = $contact->getSujet();

            $email = (new Email())
                ->from($adress)
                ->to('jtruc@parrot.fr')
                ->subject($subject)
                ->text($message);

                $mailer->send($email);
                return $this->addFlash('notice', 'Votre message a été envoyé!');
            }
                return $this->render('form/contact.html.twig', [
                    'horaires' => $horaireRepository->findAll(),
                    'annonces' => $annonceRepository->findAll()
                ]);
            }
    #[Route('/form/{id}', name: 'app_form_vehicule', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function showTitle(HoraireRepository $horaireRepository, Annonce $annonce): Response
    {
        return $this->render('form/contact.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'annonce' => $annonce
        ]);
    }
}
