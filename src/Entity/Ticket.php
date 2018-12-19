<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ticketName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ticketPays;

    /**
     * @ORM\Column(type="date")
     */
    private $ticketDate;

    /**
     * @ORM\Column(type="float")
     */
    private $rate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTicketName(): ?string
    {
        return $this->ticketName;
    }

    public function setTicketName(string $ticketName): self
    {
        $this->ticketName = $ticketName;

        return $this;
    }

    public function getTicketPays(): ?string
    {
        return $this->ticketPays;
    }

    public function setTicketPays(string $ticketPays): self
    {
        $this->ticketPays = $ticketPays;

        return $this;
    }

    public function getTicketDate(): ?\DateTimeInterface
    {
        return $this->ticketDate;
    }

    public function setTicketDate(\DateTimeInterface $ticketDate): self
    {
        $this->ticketDate = $ticketDate;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;

        return $this;
    }
}
