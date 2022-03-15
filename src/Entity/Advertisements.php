<?php

namespace App\Entity;

use App\Repository\AdvertisementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use APIPlatform\Core\Annotation\APIResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(normalizationContext: ['groups' => ['read:Advertisement']])]
#[ORM\Entity(repositoryClass: AdvertisementsRepository::class)]
class Advertisements
{
    #[Groups(['read:Advertisement'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    
    #[Groups(['read:Advertisement'])]
    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[Groups(['read:Advertisement'])]
    #[ORM\Column(type: 'date')]
    private $creation_date;

    #[Groups(['read:Advertisement'])]
    #[ORM\Column(type: 'date', nullable: true)]
    private $modification_date;

    #[ORM\Column(type: 'date', nullable: true)]
    private $suppression_date;

    #[Groups(['read:Advertisement'])]
    #[ORM\OneToMany(mappedBy: 'advertisement', targetEntity: Dogs::class)]
    private $advertisement_dogs;

    #[Groups(['read:Advertisement'])]
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
     * @return Collection<int, Dogs>
     */
    public function getAdvertisementDogs(): Collection
    {
        return $this->advertisement_dogs;
    }

    public function addAdvertisementDog(Dogs $advertisementDog): self
    {
        if (!$this->advertisement_dogs->contains($advertisementDog)) {
            $this->advertisement_dogs[] = $advertisementDog;
            $advertisementDog->setAdvertisement($this);
        }

        return $this;
    }

    public function removeAdvertisementDog(Dogs $advertisementDog): self
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
