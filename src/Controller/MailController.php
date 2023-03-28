<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Service\MailerService;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    #[Route('/mail', name: 'mail')]
    public function index(MailerService $mailerService): Response
    {
        $mailerService->sendMail('adresse@email.com', 'Merci de votre inscription');

        return $this->render('mail/index.html.twig', []);
    }
}
