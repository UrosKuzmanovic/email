<?php

namespace App\Manager;

use App\Entity\EmailSent;
use App\Repository\EmailSentRepository;

class EmailSentManager
{

    private EmailSentRepository $repository;

    public function __construct(EmailSentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param EmailSent $emailSent
     * @return EmailSent
     */
    public function add(EmailSent $emailSent): EmailSent
    {
        return $this->repository->add($emailSent);
    }

}