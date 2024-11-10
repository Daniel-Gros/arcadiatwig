<?php

namespace App\Controller;

use App\Repository\AvisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AvisController extends AbstractController
{
    #[Route('/avis', name: 'app_avis')]
    public function index(AvisRepository $avisRepository, ParameterBagInterface $parameterBagInterface): Response
    {

        $limitOfAvis = $parameterBagInterface->get('avis_limit');
        $avis = $avisRepository->findBy([], ['created_at' => 'DESC'], $limitOfAvis);



        return $this->render('avis/index.html.twig', [
            'controller_name' => 'AvisController',
            'avis' => $avis,
            'limitOfAvis' => $limitOfAvis,
        ]);
    }
}
