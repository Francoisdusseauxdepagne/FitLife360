<?php

namespace App\Entity;

use App\Repository\DetailEntrainementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailEntrainementRepository::class)]
class DetailEntrainement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $day = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $echauffement = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $exercices = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $series = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $repetitions = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'detailEntrainements')]
    private ?ProfileCoach $idProfileCoach = null;

    #[ORM\ManyToOne(inversedBy: 'detailEntrainements')]
    private ?Profile $idProfile = null;

    #[ORM\ManyToOne(inversedBy: 'detailEntrainements')]
    private ?PlanEntrainement $idPlanEntrainement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): static
    {
        $this->day = $day;

        return $this;
    }

    public function getEchauffement(): ?string
    {
        return $this->echauffement;
    }

    public function setEchauffement(string $echauffement): static
    {
        $this->echauffement = $echauffement;

        return $this;
    }

    public function getExercices(): ?string
    {
        return $this->exercices;
    }

    public function setExercices(string $exercices): static
    {
        $this->exercices = $exercices;

        return $this;
    }

    public function getSeries(): ?string
    {
        return $this->series;
    }

    public function setSeries(string $series): static
    {
        $this->series = $series;

        return $this;
    }

    public function getRepetitions(): ?string
    {
        return $this->repetitions;
    }

    public function setRepetitions(string $repetitions): static
    {
        $this->repetitions = $repetitions;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
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

    public function getIdProfile(): ?Profile
    {
        return $this->idProfile;
    }

    public function setIdProfile(?Profile $idProfile): static
    {
        $this->idProfile = $idProfile;

        return $this;
    }

    public function getIdPlanEntrainement(): ?PlanEntrainement
    {
        return $this->idPlanEntrainement;
    }

    public function setIdPlanEntrainement(?PlanEntrainement $idPlanEntrainement): static
    {
        $this->idPlanEntrainement = $idPlanEntrainement;

        return $this;
    }
}
