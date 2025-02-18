<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CeCollectivitesController extends AbstractController
{
    #[Route('/ce/collectivites', name: 'app_ce_collectivites')]
    public function index(): Response
    {
        $ceCollectivitesTitle = 'Sortie pour le Comité d\'Entreprise au Zoo Arcadia';
        return $this->render('ce_collectivites/show-ce-collectivites.html.twig', [
            'controller_name' => 'CeCollectivitesController',
            'ceCollectivitesTitle' => $ceCollectivitesTitle,
        ]);
    }
}
