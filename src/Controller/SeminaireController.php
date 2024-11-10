<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SeminaireController extends AbstractController
{
    #[Route('/seminaire', name: 'app_seminaire')]
    public function index(): Response
    {
        return $this->render('seminaire/show-seminaire.html.twig', [
            'controller_name' => 'SeminaireController',
        ]);
    }
}
