<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MaintenanceController extends AbstractController
{
    #[Route('/maintenance', name: 'app_maintenance')]
    public function index(): Response
    {

        $maintenance = '⚠️ Site en maintenance⚠️';

        return $this->render('maintenance/index.html.twig', [
            'maintenance' => $maintenance,
            'controller_name' => 'MaintenanceController',
        ]);
    }
}
