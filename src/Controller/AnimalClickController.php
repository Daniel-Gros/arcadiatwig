<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use MongoDB\Client;

class AnimalClickController extends AbstractController
{
    private $mongoClient;

    public function __construct()
    {
        $this->mongoClient = new Client('mongodb://127.0.0.1:27017');
    }

    #[Route('/animal/{id}/click', name: 'app_animal_click')]
    public function trackClick(string $id, Request $request): JsonResponse
    {
        $db = $this->mongoClient->zoo_database; // Nom de votre base de données MongoDB
        $collection = $db->animal_clicks; // Nom de la collection

        // Récupérer les détails de l'animal depuis la base SQL si nécessaire
        $animalRepository = $this->getDoctrine()->getRepository(Animal::class);
        $animal = $animalRepository->find($id);

        if (!$animal) {
            return new JsonResponse(['error' => 'Animal not found'], 404);
        }

        // Incrémenter le compteur ou insérer un nouveau document
        $collection->updateOne(
            ['animal_id' => $id],
            [
                '$setOnInsert' => ['name' => $animal->getFirstName()],
                '$inc' => ['clicks' => 1],
            ],
            ['upsert' => true]
        );

        return new JsonResponse(['success' => true, 'message' => 'Click tracked']);
    }
}

