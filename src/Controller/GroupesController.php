<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GroupesController extends AbstractController
{
    #[Route('/groupes', name: 'app_groupes')]
    public function index(): Response
    {
        $groupTitle = 'Sortie en Groupe au Zoo';
        return $this->render('groupes/show-groupes.html.twig', [
            'controller_name' => 'GroupesController',
            'groupTitle' => $groupTitle,
        ]);
    }
}
