<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

#[MongoDB\Document]
class Click
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\Field(type: "string")]
    private string $animalId;

    #[MongoDB\Field(type: "int")]
    private int $count = 0;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getAnimalId(): string
    {
        return $this->animalId;
    }

    public function setAnimalId(string $animalId): self
    {
        $this->animalId = $animalId;
        return $this;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;
        return $this;
    }
}

