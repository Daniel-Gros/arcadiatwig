<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Habitat;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AnimalController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function animalRequest (AnimalRepository $animalRepository): Response
    {
        $animals = $animalRepository->findAll();

        return $this->render('home/index.html.twig', [
            'animals' => $animals,
        ]);
    }



    #[Route('/animal', name: 'app_animal')]
    public function index(EntityManagerInterface $entityManager): Response

    {
        $habitats = $entityManager->getRepository(Habitat::class)->findAll();
        $animals = $entityManager->getRepository(Animal::class)->findAll();
        $animalTitle = 'La section des animaux';
        return $this->render('animal/show_animal.html.twig', [
            'animalTitle' => $animalTitle,
            'controller_name' => 'AnimalController',
            'habitats' => $habitats,
            'animals' => $animals,
        ]);
    }
}
