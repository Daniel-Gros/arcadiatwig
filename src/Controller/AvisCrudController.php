<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\Avis1Type;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/avis/crud')]
final class AvisCrudController extends AbstractController
{
    #[Route('/avis', name: 'app_avis_crud_index', methods: ['GET'])]
    public function index(AvisRepository $avisRepository): Response
    {
        $pendingAvis = $avisRepository->findBy(['status' => 'pending']);
    
        return $this->render('avis_crud/index.html.twig', [
            'avis' => $pendingAvis,
        ]);
    }

    #[Route('/avis/{id}/approve', name: 'app_avis_approve', methods: ['POST'])]
public function approve(Avis $avis, EntityManagerInterface $entityManager): Response
{
    $avis->setStatus('approved');
    $entityManager->flush();

    $this->addFlash('success', 'Avis approuvé.');
    return $this->redirectToRoute('app_avis_crud_index');
}

#[Route('/avis/{id}/reject', name: 'app_avis_reject', methods: ['POST'])]
public function reject(Avis $avis, EntityManagerInterface $entityManager): Response
{
    $avis->setStatus('rejected');
    $entityManager->flush();

    $this->addFlash('error', 'Avis rejeté.');
    return $this->redirectToRoute('app_avis_crud_index');
}

}