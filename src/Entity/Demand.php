<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DemandRepository")
 */
class Demand
{
    const STATUS_NEW = 1;
    const STATUS_READ = 10;
    const STATUS_FILLED = 100;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="datetimetz_immutable")
     */
    private $creation_datetime;

    /**
     * @Assert\Email()
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $receiver_email;

    /**
     * @ORM\Column(type="datetimetz_immutable", nullable=true)
     */
    private $response_datetime;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status;
    /**
     * @Assert\Ip(version="all")
     * @ORM\Column(type="string", nullable=true)
     */
    private $ip;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $userAgent;

    public function __construct()
    {
        $this->creation_datetime = new DateTimeImmutable();
        $this->status = self::STATUS_NEW;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getCreationDatetime(): ?\DateTimeImmutable
    {
        return $this->creation_datetime;
    }

    public function setCreationDatetime(\DateTimeImmutable $creation_datetime): self
    {
        $this->creation_datetime = $creation_datetime;

        return $this;
    }

    public function getReceiverEmail(): ?string
    {
        return $this->receiver_email;
    }

    public function setReceiverEmail(?string $receiver_email): self
    {
        $this->receiver_email = $receiver_email;

        return $this;
    }

    public function getResponseDatetime(): ?\DateTimeImmutable
    {
        return $this->response_datetime;
    }

    public function setResponseDatetime(?\DateTimeImmutable $response_datetime): self
    {
        $this->response_datetime = $response_datetime;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(?string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    public function setUserAgent(?string $userAgent): self
    {
        $this->userAgent = $userAgent;

        return $this;
    }
}
