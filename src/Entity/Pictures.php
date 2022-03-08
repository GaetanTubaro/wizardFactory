<?php

namespace App\Entity;

use App\Repository\PicturesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PicturesRepository::class)]
class Pictures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $path;

    #[ORM\ManyToOne(targetEntity: dogs::class, inversedBy: 'pictures')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_dog;

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

    public function getIdDog(): ?dogs
    {
        return $this->id_dog;
    }

    public function setIdDog(?dogs $id_dog): self
    {
        $this->id_dog = $id_dog;

        return $this;
    }
}
