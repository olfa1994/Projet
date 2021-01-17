<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Num;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heur_deb;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heur_fin;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->Mail;
    }

    public function setMail(string $Mail): self
    {
        $this->Mail = $Mail;

        return $this;
    }

    public function getNum(): ?string
    {
        return $this->Num;
    }

    public function setNum(string $Num): self
    {
        $this->Num = $Num;

        return $this;
    }

    public function getHeurDeb(): ?\DateTimeInterface
    {
        return $this->heur_deb;
    }

    public function setHeurDeb(?\DateTimeInterface $heur_deb): self
    {
        $this->heur_deb = $heur_deb;

        return $this;
    }

    public function getHeurFin(): ?\DateTimeInterface
    {
        return $this->heur_fin;
    }

    public function setHeurFin(?\DateTimeInterface $heur_fin): self
    {
        $this->heur_fin = $heur_fin;

        return $this;
    }




}
