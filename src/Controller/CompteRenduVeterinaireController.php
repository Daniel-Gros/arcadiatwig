<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CompteRenduVeterinaireController extends AbstractController
{
    #[Route('/compte/rendu/veterinaire', name: 'app_compte_rendu_veterinaire')]
    public function index(): Response
    {
        return $this->render('compte_rendu_veterinaire/index.html.twig', [
            'controller_name' => 'CompteRenduVeterinaireController',
        ]);
    }
}
