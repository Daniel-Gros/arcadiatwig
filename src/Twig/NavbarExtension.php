<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class NavbarExtension extends AbstractExtension
{
    private $navItems;

    public function __construct()
    {
        $this->navItems = [
            [
                'label' => 'Découvrir notre Zoo', 
                'submenu' => [
                    ['label' => 'Animaux', 'route' => 'app_animal'],
                    ['label' => 'Habitats', 'route' => 'app_habitat'],
                    ['label' => 'Engagements', 'route' => 'app_engagements'],
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
            ['label' => 'Contact', 'route' => 'app_contact'],
            // ['label' => 'mentions légales', 'route' => 'app_mentions_legales'],
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('nav_items', [$this, 'getNavItems']),
        ];
    }

    public function getNavItems(): array
    {
        return $this->navItems;
    }
}
