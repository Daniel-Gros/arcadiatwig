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
        $engagementTitle = 'Les Engagements d\'Arcadia';
        return $this->render('engagements/show-engagements.html.twig', [
            'controller_name' => 'EngagementsController',
            'engagementTitle' => $engagementTitle,
        ]);
    }
}
