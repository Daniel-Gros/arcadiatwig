<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AvisController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/avis', name: 'app_avis')]
    public function index(AvisRepository $avisRepository, ParameterBagInterface $parameterBagInterface, Request $request): Response
    {
        $avisVisiteurs = 'Les Avis Visiteurs';
        $websiteName = 'Arcadia';
        // $limitOfAvis = $parameterBagInterface->get('avis_limit');
        $avisList = $avisRepository->findBy(['status' => 'approved'], ['id' => 'DESC']);

        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $avis->setUserId($this->getUser());
            $this->entityManager->persist($avis);
            try {
                $this->entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur est survenue lors de l\'envoi de votre avis.');
                return $this->redirectToRoute('app_home');
            }

            $this->addFlash('success', 'Votre avis est en attente de validation.');
            return $this->redirectToRoute('app_home');
        }


        return $this->render('avis/show_avis.html.twig', [
            'controller_name' => 'AvisController',
            'avis' => $avisList,
            // 'limitOfAvis' => $limitOfAvis,
            'avisVisiteurs' => $avisVisiteurs,
            'websiteName' => $websiteName,
        ]);
    }
}
