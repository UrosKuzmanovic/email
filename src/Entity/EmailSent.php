<?php

namespace App\Entity;

use App\Repository\EmailSentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EmailSentRepository::class)
 * @ORM\Table(name="`email_sent`")
 */
class EmailSent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups({"view"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"view"})
     */
    private $fromEmail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"view"})
     */
    private $toEmail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"view"})
     */
    private $subject;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({"view"})
     */
    private $text;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     *
     * @Groups({"view"})
     */
    private $sentAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromEmail(): ?string
    {
        return $this->fromEmail;
    }

    public function setFromEmail(?string $fromEmail): self
    {
        $this->fromEmail = $fromEmail;

        return $this;
    }

    public function getToEmail(): ?string
    {
        return $this->toEmail;
    }

    public function setToEmail(?string $toEmail): self
    {
        $this->toEmail = $toEmail;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getSentAt(): ?\DateTimeImmutable
    {
        return $this->sentAt;
    }

    public function setSentAt(?\DateTimeImmutable $sentAt): self
    {
        $this->sentAt = $sentAt;

        return $this;
    }
}
