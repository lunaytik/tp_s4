<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService {
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMail(string $destinataire, string $subject, string $body = "La fonction sendMail prend 3 paramètres ! (destinataire, sujet, texte du corps)") {
            $email = (new Email())
                ->from('admin@lunaytik.com')
                ->to($destinataire)
                ->subject($subject)
                ->text($body)
                ->html("<h1 style='font-family: sans-serif'>$body</h1>");

            $this->mailer->send($email);
    }
}