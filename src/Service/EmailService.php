<?php

namespace App\Service;

use App\Entity\EmailSent;
use App\Manager\EmailSentManager;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService
{

    private MailerInterface $mailer;
    private EmailSentManager $emailSentManager;

    public function __construct(
        MailerInterface $mailer,
        EmailSentManager $emailSentManager
    )
    {
        $this->mailer = $mailer;
        $this->emailSentManager = $emailSentManager;
    }

    /**
     * @param EmailSent $emailSent
     * @return EmailSent
     * @throws TransportExceptionInterface
     */
    public function sendEmail(EmailSent $emailSent): EmailSent
    {
        $this->mailer->send(
            (new Email())
                ->from('test@email.com')
                ->to($emailSent->getToEmail())
                ->subject($emailSent->getSubject())
                ->text($emailSent->getText())
        );

        return $this->emailSentManager->add($emailSent);
    }

    /**
     * @param $email
     * @return EmailSent|null
     */
    public function createEmailSent($email): ?EmailSent
    {
        if (!isset($email->to) || !isset($email->subject) || !isset($email->text)) {
            return null;
        }

        return (new EmailSent())
            ->setFromEmail('email@email.com')
            ->setToEmail($email->to)
            ->setSubject($email->subject)
            ->setText($email->text)
            ->setSentAt(new \DateTimeImmutable());
    }

}