<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HabitatController extends AbstractController
{
    #[Route('/habitat', name: 'app_habitat')]
    public function index(): Response
    {
        return $this->render('habitat/index.html.twig', [
            'controller_name' => 'HabitatController',
        ]);
    }

    #[Route('/habitat/{id<\d+>}', name: 'habitat_animals')]
    public function animals(int $id, HabitatRepository $habitatRepository, AnimalRepository $animalRepository): Response
    {
        $habitat = $habitatRepository->find($id);
        $animals = $animalRepository->findBy(['habitat' => $habitat]);

        return $this->render('animal/animals_by_habitat.html.twig', [
            'habitat' => $habitat,
            'animals' => $animals,
        ]);
    }
}
