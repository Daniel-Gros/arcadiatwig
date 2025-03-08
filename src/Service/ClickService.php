<?php

namespace App\Service;

use MongoDB\Client;
use MongoDB\Collection;;

class ClickService
{
    private Collection $collection;

    public function __construct(Client $mongoClient)
    {
        $this->collection = $mongoClient->selectDatabase('zoo')->selectCollection('clicks');
    }


    public function registerClick(string $animalId): void
    {
        $this->collection->updateOne(
            ['animalId' => $animalId],
            ['$inc' => ['count' => 1]],
            ['upsert' => true]
        );


    }



    public function getClickCount(string $animalId): int
    {
        $result = $this->collection->findOne(['animalId' => $animalId]);
        return $result['count'] ?? 0;
    }
}

