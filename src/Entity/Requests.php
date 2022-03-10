<?php

namespace App\Entity;

use App\Repository\RequestsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RequestsRepository::class)]
class Requests
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: adopters::class, inversedBy: 'requests')]
    #[ORM\JoinColumn(nullable: false)]
    private $adopter;

    #[ORM\ManyToOne(targetEntity: dogs::class, inversedBy: 'requests')]
    #[ORM\JoinColumn(nullable: false)]
    private $dog;

    #[ORM\OneToMany(mappedBy: 'request', targetEntity: Messages::class)]
    private $message;

    public function __construct()
    {
        $this->message = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdopter(): ?adopters
    {
        return $this->adopter;
    }

    public function setAdopter(?adopters $adopter): self
    {
        $this->adopter = $adopter;

        return $this;
    }

    public function getDog(): ?dogs
    {
        return $this->dog;
    }

    public function setDog(?dogs $dog): self
    {
        $this->dog = $dog;

        return $this;
    }

    /**
     * @return Collection<int, Messages>
     */
    public function getMessage(): Collection
    {
        return $this->message;
    }

    public function addMessage(Messages $Message): self
    {
        if (!$this->message->contains($Message)) {
            $this->message[] = $Message;
            $Message->setRequest($this);
        }

        return $this;
    }

    public function removeMessage(Messages $Message): self
    {
        if ($this->message->removeElement($Message)) {
            // set the owning side to null (unless already changed)
            if ($Message->getRequest() === $this) {
                $Message->setRequest(null);
            }
        }

        return $this;
    }
}
