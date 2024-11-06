<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PotitrainController extends AbstractController
{
    #[Route('/potitrain', name: 'app_potitrain')]
    public function index(): Response
    {
        return $this->render('potitrain/index.html.twig', [
            'controller_name' => 'PotitrainController',
        ]);
    }
}
