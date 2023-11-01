<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\AnnonceRepository;
use App\Repository\ContactRepository;
use App\Repository\HoraireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PHPMailer\PHPMailer\PHPMailer;

class FormController extends AbstractController
{
    #[Route('/form', name: 'app_form', methods: ['GET', 'POST'])]
    public function newContact(HoraireRepository $horaireRepository, ContactRepository $contactRepository, AnnonceRepository $annonceRepository, Request $request, EntityManagerInterface $manager): Response
    {
        $contact = new Contact();

        $form= $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $contactRepository -> save($contact, true);
            $email = $contact->getEmail();
            $nom = $contact->getNom();
            $prenom = $contact->getPrenom();
            $titre = $contact->getTitre();
            $objet = $contact->getObjet();
            $sujet = $contact->getSujet();

            $phpmailer = new PHPMailer(true);
            $phpmailer->isSMTP();
            $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 2525;
            $phpmailer->Username = '43ac6b1ed0c920';
            $phpmailer->Password = 'e8274b3c0028cb';
            $phpmailer->CharSet = 'UTF-8';
            
            $phpmailer->setFrom($email, $nom); 
            $phpmailer->addAddress('vparrot@parrot.fr', 'Vincent Parrot');
            $phpmailer->Subject = ($objet);
            $phpmailer->isHTML(true);
            $format = '%s %s %s a écrit : %s';
            $phpmailer->Body = sprintf($format, $titre, $prenom, $nom, $sujet);
            
            $phpmailer->send();

            $manager->persist($contact);
            $manager->flush();
            $this->addFlash('notice', 'Message envoyé! Une réponse vous sera apporté dans les meilleurs délais.');
            return $this->redirectToRoute('app_form');
            }
                return $this->render('form/contact.html.twig', [
                    'horaires' => $horaireRepository->findAll(),
                    'annonces' => $annonceRepository->findAll(),
                    'formView' => $form->createView(),
                ]);
            }
    #[Route('/form/{id}', name: 'app_form_vehicule', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function showTitle(HoraireRepository $horaireRepository, ContactRepository $contactRepository, Annonce $annonce, Request $request, EntityManagerInterface $manager): Response
    {
        
        $contact = new Contact();
        
        $form= $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $contactRepository -> save($contact, true);
            $email = $contact->getEmail();
            $nom = $contact->getNom();
            $prenom = $contact->getPrenom();
            $titre = $contact->getTitre();
            $objet = $contact->getObjet();
            $sujet = $contact->getSujet();

            $phpmailer = new PHPMailer(true);
            $phpmailer->isSMTP();
            $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 2525;
            $phpmailer->Username = '43ac6b1ed0c920';
            $phpmailer->Password = 'e8274b3c0028cb';
            $phpmailer->CharSet = 'UTF-8';
            
            $phpmailer->setFrom($email, $nom); 
            $phpmailer->addAddress('vparrot@parrot.fr', 'Vincent Parrot');
            $phpmailer->Subject = ($objet);
            $phpmailer->isHTML(true);
            $format = '%s %s %s a écrit : %s';
            $phpmailer->Body = sprintf($format, $titre, $prenom, $nom, $sujet);
            
            $phpmailer->send();

            $manager->persist($contact);
            $manager->flush();
            $this->addFlash('notice', 'Message envoyé! Une réponse vous sera apporté dans les meilleurs délais.');
            return $this->redirectToRoute('app_form');
        }
            return $this->render('form/contact.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'annonces' => $annonce,
            'formView' => $form->createView(),
            ]);   
    }
}
