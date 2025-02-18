<?php

namespace App\Controller;

use App\Repository\HorairesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HorairesController extends AbstractController
{
    #[Route('/horaires', name: 'app_horaires')]
    public function index(HorairesRepository $horairesRepository): Response
    {
        $horairesTitle = 'Les horaires d\'Arcadia';
        $horaires = $horairesRepository->findAll();
        return $this->render('horaires/index.html.twig', [
            'controller_name' => 'HorairesController',
            'horaires' => $horaires,
            'horairesTitle' => $horairesTitle,
        ]);
    }
}
