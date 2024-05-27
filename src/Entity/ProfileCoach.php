<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfileCoachRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ProfileCoachRepository::class)]
#[Vich\Uploadable]
class ProfileCoach
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Vich\UploadableField(mapping: 'photos', fileNameProperty: 'photo')]
    private ?File $photoFile = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $dob = null;

    #[ORM\Column(length: 255)]
    private ?string $diplome = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $experience = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $bio = null;

    #[ORM\OneToOne(inversedBy: 'profileCoach', cascade: ['persist', 'remove'])]
    private ?User $idUser = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    /**
     * @var Collection<int, PlanEntrainement>
     */
    #[ORM\OneToMany(targetEntity: PlanEntrainement::class, mappedBy: 'idProfileCoach')]
    private Collection $planEntrainements;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contrat = null;

    /**
     * @var Collection<int, DetailEntrainement>
     */
    #[ORM\OneToMany(targetEntity: DetailEntrainement::class, mappedBy: 'idProfileCoach')]
    private Collection $detailEntrainements;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'idProfileCoach')]
    private Collection $reservations;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    /**
     * @var Collection<int, Profile>
     */
    #[ORM\OneToMany(targetEntity: Profile::class, mappedBy: 'idProfileCoach')]
    private Collection $profiles;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $expertise = null;

    public function __construct()
    {
        $this->planEntrainements = new ArrayCollection();
        $this->detailEntrainements = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->profiles = new ArrayCollection();
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
    }

    public function getPhotoFile(): ?File
    {
        return $this->photoFile;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDob(): ?\DateTimeImmutable
    {
        return $this->dob;
    }

    public function setDob(\DateTimeImmutable $dob): static
    {
        $this->dob = $dob;

        return $this;
    }

    public function getDiplome(): ?string
    {
        return $this->diplome;
    }

    public function setDiplome(string $diplome): static
    {
        $this->diplome = $diplome;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(?string $experience): static
    {
        $this->experience = $experience;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

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

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setActive(bool $isActive): static
    {
        $this->isActive = $isActive;

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
            $planEntrainement->setIdProfileCoach($this);
        }

        return $this;
    }

    public function removePlanEntrainement(PlanEntrainement $planEntrainement): static
    {
        if ($this->planEntrainements->removeElement($planEntrainement)) {
            // set the owning side to null (unless already changed)
            if ($planEntrainement->getIdProfileCoach() === $this) {
                $planEntrainement->setIdProfileCoach(null);
            }
        }

        return $this;
    }

    public function getContrat(): ?string
    {
        return $this->contrat;
    }

    public function setContrat(?string $contrat): static
    {
        $this->contrat = $contrat;

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
            $detailEntrainement->setIdProfileCoach($this);
        }

        return $this;
    }

    public function removeDetailEntrainement(DetailEntrainement $detailEntrainement): static
    {
        if ($this->detailEntrainements->removeElement($detailEntrainement)) {
            // set the owning side to null (unless already changed)
            if ($detailEntrainement->getIdProfileCoach() === $this) {
                $detailEntrainement->setIdProfileCoach(null);
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
            $reservation->setIdProfileCoach($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getIdProfileCoach() === $this) {
                $reservation->setIdProfileCoach(null);
            }
        }

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return Collection<int, Profile>
     */
    public function getProfiles(): Collection
    {
        return $this->profiles;
    }

    public function addProfile(Profile $profile): static
    {
        if (!$this->profiles->contains($profile)) {
            $this->profiles->add($profile);
            $profile->setIdProfileCoach($this);
        }

        return $this;
    }

    public function removeProfile(Profile $profile): static
    {
        if ($this->profiles->removeElement($profile)) {
            // set the owning side to null (unless already changed)
            if ($profile->getIdProfileCoach() === $this) {
                $profile->setIdProfileCoach(null);
            }
        }

        return $this;
    }

    public function __toString() : string
    {
        return $this->id;
    }

    public function getExpertise(): ?string
    {
        return $this->expertise;
    }

    public function setExpertise(string $expertise): static
    {
        $this->expertise = $expertise;

        return $this;
    }
}
