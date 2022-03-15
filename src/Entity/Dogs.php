<?php

namespace App\Entity;

use App\Repository\DogsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use APIPlatform\Core\Annotation\APIResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(normalizationContext: ['groups' => ['read:Dog']])]
#[ORM\Entity(repositoryClass: DogsRepository::class)]
class Dogs
{
    #[Groups(["read:Dog"])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(["read:Dog", 'read:Advertisement'])]
    #[ORM\Column(type: 'string', length: 30)]
    private $name;

    #[Groups(["read:Dog", "read:Advertisement"])]
    #[ORM\Column(type: 'date')]
    private $birth_date;

    #[Groups(["read:Dog", "read:Advertisement"])]
    #[ORM\Column(type: 'text', nullable: true)]
    private $past;

    #[Groups(["read:Dog", "read:Advertisement"])]
    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[Groups(["read:Dog", "read:Advertisement"])]
    #[ORM\Column(type: 'boolean')]
    private $isLOF;

    #[Groups(["read:Dog", "read:Advertisement"])]
    #[ORM\Column(type: 'boolean')]
    private $otherAnimals;

    #[Groups(["read:Dog", "read:Advertisement"])]
    #[ORM\Column(type: 'boolean')]
    private $isAdopted;

    #[Groups(["read:Dog", "read:Advertisement"])]
    #[ORM\OneToMany(mappedBy: 'dog', targetEntity: Pictures::class)]
    private $pictures;

    #[Groups(["read:Dog", "read:Advertisement"])]
    #[ORM\ManyToMany(targetEntity: Species::class)]
    private $dog_species;
    
    #[ORM\ManyToOne(targetEntity: Advertisements::class, inversedBy: 'advertisement_dogs')]
    #[ORM\JoinColumn(nullable: false)]
    private $advertisement;

    #[ORM\OneToMany(mappedBy: 'dog', targetEntity: Requests::class)]
    private $requests;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->dog_species = new ArrayCollection();
        $this->requests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getPast(): ?string
    {
        return $this->past;
    }

    public function setPast(?string $past): self
    {
        $this->past = $past;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsLOF(): ?bool
    {
        return $this->isLOF;
    }

    public function setIsLOF(bool $isLOF): self
    {
        $this->isLOF = $isLOF;

        return $this;
    }

    public function getOtherAnimals(): ?bool
    {
        return $this->otherAnimals;
    }

    public function setOtherAnimals(bool $otherAnimals): self
    {
        $this->otherAnimals = $otherAnimals;

        return $this;
    }

    public function getIsAdopted(): ?bool
    {
        return $this->isAdopted;
    }

    public function setIsAdopted(bool $isAdopted): self
    {
        $this->isAdopted = $isAdopted;

        return $this;
    }

    /**
     * @return Collection<int, Pictures>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Pictures $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setDog($this);
        }

        return $this;
    }

    public function removePicture(Pictures $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getDog() === $this) {
                $picture->setDog(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Species>
     */
    public function getDogSpecies(): Collection
    {
        return $this->dog_species;
    }

    public function addDogSpecies(Species $dogSpecies): self
    {
        if (!$this->dog_species->contains($dogSpecies)) {
            $this->dog_species[] = $dogSpecies;
        }

        return $this;
    }

    public function removeDogSpecies(Species $dogSpecies): self
    {
        $this->dog_species->removeElement($dogSpecies);

        return $this;
    }

    public function getAdvertisement(): ?Advertisements
    {
        return $this->advertisement;
    }

    public function setAdvertisement(?Advertisements $advertisement): self
    {
        $this->advertisement = $advertisement;

        return $this;
    }

    /**
     * @return Collection<int, Requests>
     */
    public function getRequests(): Collection
    {
        return $this->requests;
    }

    public function addRequest(Requests $request): self
    {
        if (!$this->requests->contains($request)) {
            $this->requests[] = $request;
            $request->setDog($this);
        }

        return $this;
    }

    public function removeRequest(Requests $request): self
    {
        if ($this->requests->removeElement($request)) {
            // set the owning side to null (unless already changed)
            if ($request->getDog() === $this) {
                $request->setDog(null);
            }
        }

        return $this;
    }
}
