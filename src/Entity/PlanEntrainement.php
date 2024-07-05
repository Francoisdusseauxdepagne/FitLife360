<?php

namespace App\Entity;

use App\Repository\PlanEntrainementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanEntrainementRepository::class)]
class PlanEntrainement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $duree = null;

    #[ORM\Column(length: 255)]
    private ?string $objectif = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $niveau = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'planEntrainements')]
    private ?Profile $idProfile = null;

    #[ORM\ManyToOne(inversedBy: 'planEntrainements')]
    private ?ProfileCoach $idProfileCoach = null;

    /**
     * @var Collection<int, DetailEntrainement>
     */
    #[ORM\OneToMany(targetEntity: DetailEntrainement::class, mappedBy: 'idPlanEntrainement')]
    private Collection $detailEntrainements;

    public function __construct()
    {
        $this->detailEntrainements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getObjectif(): ?string
    {
        return $this->objectif;
    }

    public function setObjectif(string $objectif): static
    {
        $this->objectif = $objectif;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

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

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

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

    public function getIdProfileCoach(): ?ProfileCoach
    {
        return $this->idProfileCoach;
    }

    public function setIdProfileCoach(?ProfileCoach $idProfileCoach): static
    {
        $this->idProfileCoach = $idProfileCoach;

        return $this;
    }

    /**
     * @return Collection<int, DetailEntrainement>
     */
    public function getDetailEntrainements(): Collection
    {
        return $this->detailEntrainements;
    }

    public function addDetailEntrainement(DetailEntrainement $detailEntrainement): static
    {
        if (!$this->detailEntrainements->contains($detailEntrainement)) {
            $this->detailEntrainements->add($detailEntrainement);
            $detailEntrainement->setIdPlanEntrainement($this);
        }

        return $this;
    }

    public function removeDetailEntrainement(DetailEntrainement $detailEntrainement): static
    {
        if ($this->detailEntrainements->removeElement($detailEntrainement)) {
            // set the owning side to null (unless already changed)
            if ($detailEntrainement->getIdPlanEntrainement() === $this) {
                $detailEntrainement->setIdPlanEntrainement(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
