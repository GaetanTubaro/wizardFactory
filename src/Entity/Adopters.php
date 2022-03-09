<?php

namespace App\Entity;

use App\Repository\AdoptersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdoptersRepository::class)]
class Adopters extends User
{
    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $mail;

    #[ORM\Column(type: 'string', length: 15, nullable: true)]
    private $phone;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $city;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $department;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $surname;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $child;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $gotAnimals;

    #[ORM\OneToMany(mappedBy: 'adopter', targetEntity: Requests::class)]
    private $requests;

    public function __construct()
    {
        $this->requests = new ArrayCollection();
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(?string $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getChild(): ?int
    {
        return $this->child;
    }

    public function setChild(?int $child): self
    {
        $this->child = $child;

        return $this;
    }

    public function getGotAnimals(): ?bool
    {
        return $this->gotAnimals;
    }

    public function setGotAnimals(?bool $gotAnimals): self
    {
        $this->gotAnimals = $gotAnimals;

        return $this;
    }

    /**
     * @return Collection<int, Requestss>
     */
    public function getRequests(): Collection
    {
        return $this->requests;
    }

    public function addRequests(Requests $requests): self
    {
        if (!$this->requests->contains($requests)) {
            $this->requests[] = $requests;
            $requests->setAdopter($this);
        }

        return $this;
    }

    public function removeRequests(Requests $requests): self
    {
        if ($this->requests->removeElement($requests)) {
            // set the owning side to null (unless already changed)
            if ($requests->getAdopter() === $this) {
                $requests->setAdopter(null);
            }
        }

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = parent::getRoles();
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_ADOPTERS';

        return array_unique($roles);
    }
}
