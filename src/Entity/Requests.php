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
    private $id_adopter;

    #[ORM\ManyToOne(targetEntity: dogs::class, inversedBy: 'requests')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_dog;

    #[ORM\OneToMany(mappedBy: 'request', targetEntity: messages::class)]
    private $id_message;

    public function __construct()
    {
        $this->id_message = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAdopter(): ?adopters
    {
        return $this->id_adopter;
    }

    public function setIdAdopter(?adopters $id_adopter): self
    {
        $this->id_adopter = $id_adopter;

        return $this;
    }

    public function getIdDog(): ?dogs
    {
        return $this->id_dog;
    }

    public function setIdDog(?dogs $id_dog): self
    {
        $this->id_dog = $id_dog;

        return $this;
    }

    /**
     * @return Collection<int, messages>
     */
    public function getIdMessage(): Collection
    {
        return $this->id_message;
    }

    public function addIdMessage(messages $idMessage): self
    {
        if (!$this->id_message->contains($idMessage)) {
            $this->id_message[] = $idMessage;
            $idMessage->setRequest($this);
        }

        return $this;
    }

    public function removeIdMessage(messages $idMessage): self
    {
        if ($this->id_message->removeElement($idMessage)) {
            // set the owning side to null (unless already changed)
            if ($idMessage->getRequest() === $this) {
                $idMessage->setRequest(null);
            }
        }

        return $this;
    }
}
