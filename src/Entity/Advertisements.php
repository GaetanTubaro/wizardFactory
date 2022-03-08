<?php

namespace App\Entity;

use App\Repository\AdvertisementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvertisementsRepository::class)]
class Advertisements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'date')]
    private $creation_date;

    #[ORM\Column(type: 'date', nullable: true)]
    private $modification_date;

    #[ORM\Column(type: 'date', nullable: true)]
    private $suppression_date;

    #[ORM\OneToMany(mappedBy: 'advertisement', targetEntity: dogs::class)]
    private $advertisement_dogs;

    #[ORM\ManyToOne(targetEntity: Associations::class, inversedBy: 'asso_ad')]
    #[ORM\JoinColumn(nullable: false)]
    private $association;

    public function __construct()
    {
        $this->advertisement_dogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getModificationDate(): ?\DateTimeInterface
    {
        return $this->modification_date;
    }

    public function setModificationDate(?\DateTimeInterface $modification_date): self
    {
        $this->modification_date = $modification_date;

        return $this;
    }

    public function getSuppressionDate(): ?\DateTimeInterface
    {
        return $this->suppression_date;
    }

    public function setSuppressionDate(?\DateTimeInterface $suppression_date): self
    {
        $this->suppression_date = $suppression_date;

        return $this;
    }

    /**
     * @return Collection<int, dogs>
     */
    public function getAdvertisementDogs(): Collection
    {
        return $this->advertisement_dogs;
    }

    public function addAdvertisementDog(dogs $advertisementDog): self
    {
        if (!$this->advertisement_dogs->contains($advertisementDog)) {
            $this->advertisement_dogs[] = $advertisementDog;
            $advertisementDog->setAdvertisement($this);
        }

        return $this;
    }

    public function removeAdvertisementDog(dogs $advertisementDog): self
    {
        if ($this->advertisement_dogs->removeElement($advertisementDog)) {
            // set the owning side to null (unless already changed)
            if ($advertisementDog->getAdvertisement() === $this) {
                $advertisementDog->setAdvertisement(null);
            }
        }

        return $this;
    }

    public function getAssociation(): ?Associations
    {
        return $this->association;
    }

    public function setAssociation(?Associations $association): self
    {
        $this->association = $association;

        return $this;
    }
}
