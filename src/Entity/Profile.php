<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ProfileRepository::class)]
#[Vich\Uploadable]
class Profile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Vich\UploadableField(mapping: 'photos', fileNameProperty: 'photo')]
    private ?File $photoFile = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column(length: 255)]
    private ?string $sexe = null;

    #[ORM\Column(length: 255)]
    private ?string $objectifSportif = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $bio = null;

    #[ORM\OneToOne(inversedBy: 'profile', cascade: ['persist', 'remove'])]
    private ?User $idUser = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\ManyToOne(inversedBy: 'profiles')]
    private ?Abonnement $idAbonnement = null;

    /**
     * @var Collection<int, PlanAlimentaire>
     */
    #[ORM\OneToMany(targetEntity: PlanAlimentaire::class, mappedBy: 'idProfile')]
    private Collection $planAlimentaires;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'idProfile')]
    private Collection $comments;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'idProfile')]
    private Collection $reservations;

    /**
     * @var Collection<int, PlanEntrainement>
     */
    #[ORM\OneToMany(targetEntity: PlanEntrainement::class, mappedBy: 'idProfile')]
    private Collection $planEntrainements;

    /**
     * @var Collection<int, Panier>
     */
    #[ORM\OneToMany(targetEntity: Panier::class, mappedBy: 'idProfile')]
    private Collection $paniers;

    #[ORM\ManyToOne(inversedBy: 'profiles')]
    private ?Coach $idCoach = null;

    public function __construct()
    {
        $this->planAlimentaires = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->planEntrainements = new ArrayCollection();
        $this->paniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

     /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $avatarFile
     */

     public function setPhotoFile(?File $photoFile = null): void
    {
        $this->photoFile = $photoFile;

        if (null !== $photoFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getPhotoFile(): ?File
    {
        return $this->photoFile;
    }


    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): static
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getObjectifSportif(): ?string
    {
        return $this->objectifSportif;
    }

    public function setObjectifSportif(string $objectifSportif): static
    {
        $this->objectifSportif = $objectifSportif;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): static
    {
        $this->bio = $bio;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): static
    {
        $this->idUser = $idUser;

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

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getIdAbonnement(): ?Abonnement
    {
        return $this->idAbonnement;
    }

    public function setIdAbonnement(?Abonnement $idAbonnement): static
    {
        $this->idAbonnement = $idAbonnement;

        return $this;
    }

    /**
     * @return Collection<int, PlanAlimentaire>
     */
    public function getPlanAlimentaires(): Collection
    {
        return $this->planAlimentaires;
    }

    public function addPlanAlimentaire(PlanAlimentaire $planAlimentaire): static
    {
        if (!$this->planAlimentaires->contains($planAlimentaire)) {
            $this->planAlimentaires->add($planAlimentaire);
            $planAlimentaire->setIdProfile($this);
        }

        return $this;
    }

    public function removePlanAlimentaire(PlanAlimentaire $planAlimentaire): static
    {
        if ($this->planAlimentaires->removeElement($planAlimentaire)) {
            // set the owning side to null (unless already changed)
            if ($planAlimentaire->getIdProfile() === $this) {
                $planAlimentaire->setIdProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setIdProfile($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getIdProfile() === $this) {
                $comment->setIdProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setIdProfile($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getIdProfile() === $this) {
                $reservation->setIdProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlanEntrainement>
     */
    public function getPlanEntrainements(): Collection
    {
        return $this->planEntrainements;
    }

    public function addPlanEntrainement(PlanEntrainement $planEntrainement): static
    {
        if (!$this->planEntrainements->contains($planEntrainement)) {
            $this->planEntrainements->add($planEntrainement);
            $planEntrainement->setIdProfile($this);
        }

        return $this;
    }

    public function removePlanEntrainement(PlanEntrainement $planEntrainement): static
    {
        if ($this->planEntrainements->removeElement($planEntrainement)) {
            // set the owning side to null (unless already changed)
            if ($planEntrainement->getIdProfile() === $this) {
                $planEntrainement->setIdProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Panier>
     */
    public function getPaniers(): Collection
    {
        return $this->paniers;
    }

    public function addPanier(Panier $panier): static
    {
        if (!$this->paniers->contains($panier)) {
            $this->paniers->add($panier);
            $panier->setIdProfile($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): static
    {
        if ($this->paniers->removeElement($panier)) {
            // set the owning side to null (unless already changed)
            if ($panier->getIdProfile() === $this) {
                $panier->setIdProfile(null);
            }
        }

        return $this;
    }

    public function getIdCoach(): ?Coach
    {
        return $this->idCoach;
    }

    public function setIdCoach(?Coach $idCoach): static
    {
        $this->idCoach = $idCoach;

        return $this;
    }
}
