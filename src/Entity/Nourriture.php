<?php

namespace App\Entity;

use App\Repository\NourritureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NourritureRepository::class)]
class Nourriture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 100)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: TypeNourriture::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeNourriture $type = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getType(): ?TypeNourriture
    {
        return $this->type;
    }

    public function setType(TypeNourriture $type): static
    {
        $this->type = $type;

        return $this;
    }
}
