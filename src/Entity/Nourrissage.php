<?php

namespace App\Entity;

use App\Repository\NourrissageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: NourrissageRepository::class)]
class Nourrissage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datetime = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne(targetEntity: Animal::class, inversedBy: 'nourrissages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animal $animal = null;

    #[ORM\ManyToOne(targetEntity: Nourriture::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Nourriture $nourriture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): static
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(Animal $animal): static
    {
        $this->animal = $animal;

        return $this;
    }

    public function getNourriture(): ?Nourriture
    {
        return $this->nourriture;
    }

    public function setNourriture(Nourriture $nourriture): static
    {
        $this->nourriture = $nourriture;

        return $this;
    }
}
