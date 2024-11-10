<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {

       // NAVBAR CONFIGUREE AVEC LES FUTURES ROUTES DE TOUTES LES PAGES
        $navItems = [
            [
                'label' => 'Découvrir notre Zoo', 
                'submenu' => [
                    ['label' => 'Animaux', 'route' => 'app_animal'],
                    ['label' => 'Habitats', 'route' => 'app_habitat'],
                    ['label' => 'Engagements', 'route' => 'app_engagements']
                ]
            ],
            [
                'label' => 'Venir au Zoo', 
                'submenu' => [
                    ['label' => 'Accès', 'route' => 'app_acces'],
                    ['label' => 'Horaires', 'route' => 'app_horaires'],
                    ['label' => 'Plan du Zoo', 'route' => 'app_plan_du_zoo'],
                    ['label' => 'Restaurants', 'route' => 'app_restaurants']
                ]
            ],
            [
                'label' => 'Aventures', 
                'submenu' => [
                    ['label' => 'Le Potitrain', 'route' => 'app_potitrain'],
                    ['label' => 'Animations soigneurs', 'route' => 'app_animations_soigneurs'],
                    ['label' => 'Fêter son anniversaire', 'route' => 'app_anniversaire']
                ]
            ],
            [
                'label' => 'Professionnels', 
                'submenu' => [
                    ['label' => 'Sortie scolaire', 'route' => 'app_sortie_scolaire'],
                    ['label' => 'Groupes', 'route' => 'app_groupes'],
                    ['label' => 'CE et collectivités', 'route' => 'app_ce_collectivites'],
                    ['label' => 'Séminaire', 'route' => 'app_seminaire']
                ]
            ],
            ['label' => 'Avis', 'route' => 'app_avis'],
            ['label' => 'Contact', 'route' => 'app_contact'],
            ['label' => 'Connexion', 'route' => 'app_login']
        ];
        
        
        $website = 'Arcadia';
        return $this->render('home/index.html.twig', [
            'navItems' => $navItems,
            'website' => $website,
            'controller_name' => 'HomeController',
        ]);
    }
}
