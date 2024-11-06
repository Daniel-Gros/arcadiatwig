<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EngagementsController extends AbstractController
{
    #[Route('/engagements', name: 'app_engagements')]
    public function index(): Response
    {
        return $this->render('engagements/index.html.twig', [
            'controller_name' => 'EngagementsController',
        ]);
    }
}
