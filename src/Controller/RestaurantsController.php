<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RestaurantsController extends AbstractController
{
    #[Route('/restaurants', name: 'app_restaurants')]
    public function index(): Response
    {
        return $this->render('restaurants/index.html.twig', [
            'controller_name' => 'RestaurantsController',
        ]);
    }
}
