<?php

namespace App\Entity;

use App\Repository\CommentaireHabitatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireHabitatRepository::class)]
class CommentaireHabitat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\Column]
    private ?bool $improvement = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Habitat $habitat_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function isimprovement(): ?bool
    {
        return $this->improvement;
    }

    public function setimprovement(bool $improvement): static
    {
        $this->improvement = $improvement;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getHabitatId(): ?Habitat
    {
        return $this->habitat_id;
    }

    public function setHabitatId(?Habitat $habitat_id): static
    {
        $this->habitat_id = $habitat_id;

        return $this;
    }
}
