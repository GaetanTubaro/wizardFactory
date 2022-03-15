<?php

namespace App\Entity;

use App\Repository\SpeciesRepository;
use Doctrine\ORM\Mapping as ORM;
use APIPlatform\Core\Annotation\APIResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource()]
#[ORM\Entity(repositoryClass: SpeciesRepository::class)]
class Species
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(["read:Dog", 'read:Advertisement'])]
    #[ORM\Column(type: 'string', length: 25)]
    private $name;

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
}
