<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_order;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_order;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email_order;

    /**
     * @ORM\Column(type="integer")
     */
    private $ref_order;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date_order;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date_order = $date;

        return $this;
    }

    public function getTypeOrder(): ?string
    {
        return $this->type_order;
    }

    public function setTypeOrder(string $type_order): self
    {
        $this->type_order = $type_order;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getEmailOrder(): ?string
    {
        return $this->email_order;
    }

    public function setEmailOrder(string $email_order): self
    {
        $this->email_order = $email_order;

        return $this;
    }

    public function getRefOrder(): ?int
    {
        return $this->ref_order;
    }

    public function setRefOrder(int $ref_order): self
    {
        $this->ref_order = $ref_order;

        return $this;
    }
}
