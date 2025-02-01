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

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\OneToOne(targetEntity: self::class, mappedBy: 'nourriture_id', cascade: ['persist', 'remove'])]
    private ?self $nourrissage = null;

    #[ORM\OneToOne(mappedBy: 'nourriture', cascade: ['persist', 'remove'])]
    private ?Typenourriture $typenourriture = null;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getNourrissage(): ?self
    {
        return $this->nourrissage;
    }

    public function setNourrissage(self $nourrissage): static
    {
        // set the owning side of the relation if necessary
        if ($nourrissage->getNourritureId() !== $this) {
            $nourrissage->setNourritureId($this);
        }

        $this->nourrissage = $nourrissage;

        return $this;
    }

    public function getTypenourriture(): ?Typenourriture
    {
        return $this->typenourriture;
    }

    public function setTypenourriture(Typenourriture $typenourriture): static
    {
        // set the owning side of the relation if necessary
        if ($typenourriture->getNourriture() !== $this) {
            $typenourriture->setNourriture($this);
        }

        $this->typenourriture = $typenourriture;

        return $this;
    }
}
