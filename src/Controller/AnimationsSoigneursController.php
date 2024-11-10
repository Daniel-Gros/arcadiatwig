<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AnimationsSoigneursController extends AbstractController
{
    #[Route('/animations/soigneurs', name: 'app_animations_soigneurs')]
    public function index(): Response
    {
        return $this->render('animations_soigneurs/show-animation-soigneur.html.twig', [
            'controller_name' => 'AnimationsSoigneursController',
        ]);
    }
}
