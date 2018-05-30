<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DemandRepository")
 */
class Demand
{
    const STATUS_NEW = 1;

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
     * @ORM\Column(type="json_array", nullable=true)
     */
    private $responseData;

    public function __construct()
    {
        $this->creation_datetime = new DateTimeImmutable();
        $this->status = self::STATUS_NEW;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreationDatetime(): ?\DateTimeInterface
    {
        return $this->creation_datetime;
    }

    public function setCreationDatetime(\DateTimeInterface $creation_datetime): self
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

    public function getResponseDatetime(): ?\DateTimeInterface
    {
        return $this->response_datetime;
    }

    public function setResponseDatetime(?\DateTimeInterface $response_datetime): self
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

    public function getResponseData()
    {
        return $this->responseData;
    }

    public function setResponseData($responseData): self
    {
        $this->responseData = $responseData;

        return $this;
    }
}
