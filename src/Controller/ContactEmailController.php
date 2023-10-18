<?php

namespace App\Controller;

use App\Repository\HoraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PHPMailer\PHPMailer\PHPMailer;


class ContactEmailController extends AbstractController
{
    #[Route('/contact/email', name: 'app_contact_email')]
    public function sendMail(HoraireRepository $horaireRepository): Response
    {
        $titre = $_POST['titre'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $nomcomplet = "$nom " . " $prenom";
        $email = $_POST['email'];
        $objet = $_POST['objet'];
        $sujet = $_POST['sujet'];

        $phpmailer = new PHPMailer(true);
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '43ac6b1ed0c920';
        $phpmailer->Password = 'e8274b3c0028cb';

        $phpmailer->setFrom($email, $nomcomplet);
        $phpmailer->addAddress('mich@gmail.com', 'mich');
        $phpmailer->Subject = $objet;
        $format = '%s %s %s a écrit : %s';
        $phpmailer->Body = sprintf($format, $titre, $prenom, $nom, $sujet);

        $phpmailer->send();
        $this->addFlash('notice', 'Message envoyé! Une réponse vous sera apporté dans les meilleurs délais.');
        return $this->render('form/contact.html.twig', [
            'horaires'=>$horaireRepository->findAll(),
        ]);
    }
}
