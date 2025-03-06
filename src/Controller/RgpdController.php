<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RgpdController extends AbstractController
{
    #[Route('/rgpd', name: 'app_rgpd')]
    public function index(): Response
    {
        $rgpdTitle = 'Registre de protection des données';
        return $this->render('rgpd/index.html.twig', [
            'controller_name' => 'RgpdController',
            'rgpd' => $rgpdTitle,
        ]);
    }
}
