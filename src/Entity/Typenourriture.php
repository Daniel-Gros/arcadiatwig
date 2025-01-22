<?php

namespace App\Entity;

use App\Repository\TypenourritureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypenourritureRepository::class)]
class Typenourriture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(inversedBy: 'typenourriture', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?nourriture $nourriture = null;

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

    public function getNourriture(): ?nourriture
    {
        return $this->nourriture;
    }

    public function setNourriture(nourriture $nourriture): static
    {
        $this->nourriture = $nourriture;

        return $this;
    }
}
