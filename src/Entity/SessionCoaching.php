<?php

namespace App\Entity;

use App\Repository\SessionCoachingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionCoachingRepository::class)]
class SessionCoaching
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'sessionCoachings')]
    private ?ProfileCoach $idProfileCoach = null;

    #[ORM\Column(nullable: true)]
    private ?string $prix = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lieu = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProfileCoach(): ?ProfileCoach
    {
        return $this->idProfileCoach;
    }

    public function setIdProfileCoach(?ProfileCoach $idProfileCoach): static
    {
        $this->idProfileCoach = $idProfileCoach;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(?string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }
}
