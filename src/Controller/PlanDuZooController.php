<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PlanDuZooController extends AbstractController
{
    #[Route('/plan/du/zoo', name: 'app_plan_du_zoo')]
    public function index(): Response
    {
        return $this->render('plan_du_zoo/index.html.twig', [
            'controller_name' => 'PlanDuZooController',
        ]);
    }
}
