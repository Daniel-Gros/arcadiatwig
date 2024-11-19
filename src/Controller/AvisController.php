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

        $limitOfAvis = $parameterBagInterface->get('avis_limit');
        $avis = $avisRepository->findBy([], ['id' => 'DESC'], $limitOfAvis);

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

            $this->addFlash('success', 'Votre avis a été envoyé avec succès.');
            return $this->redirectToRoute('app_home');
        }


        return $this->render('avis/index.html.twig', [
            'controller_name' => 'AvisController',
            'avis' => $avis,
            'limitOfAvis' => $limitOfAvis,
        ]);
    }
}
