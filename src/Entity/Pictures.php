<?php

namespace App\Entity;

use App\Repository\PicturesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PicturesRepository::class)]
class Pictures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(['read:Advertisement', 'read:Dog'])]
    #[ORM\Column(type: 'string', length: 255)]
    private $path;

    #[ORM\ManyToOne(targetEntity: Dogs::class, inversedBy: 'pictures')]
    #[ORM\JoinColumn(nullable: false)]
    private $dog;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getDog(): ?Dogs
    {
        return $this->dog;
    }

    public function setDog(?Dogs $dog): self
    {
        $this->dog = $dog;

        return $this;
    }
}
