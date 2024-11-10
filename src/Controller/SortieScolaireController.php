<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SortieScolaireController extends AbstractController
{
    #[Route('/sortie/scolaire', name: 'app_sortie_scolaire')]
    public function index(): Response
    {
        return $this->render('sortie_scolaire/show-sortie-scolaire.html.twig', [
            'controller_name' => 'SortieScolaireController',
        ]);
    }
}
