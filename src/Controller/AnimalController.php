<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AnimalController extends AbstractController
{
    #[Route('/animal', name: 'app_animal')]
    public function index(): Response
    
    {
        $animalTitle = 'La section des animaux';
        return $this->render('animal/show_animal.html.twig', [
            'animalTitle' => $animalTitle,
            'controller_name' => 'AnimalController',
        ]);
    }
}
