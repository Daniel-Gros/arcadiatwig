<?php

namespace App\Controller;

use App\Entity\Nourriture;
use App\Form\NourritureType;
use App\Repository\NourritureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/nourriture/crud')]
final class NourritureCrudController extends AbstractController
{
    #[Route(name: 'app_nourriture_crud_index', methods: ['GET'])]
    public function index(NourritureRepository $nourritureRepository): Response
    {
        return $this->render('nourriture_crud/index.html.twig', [
            'nourritures' => $nourritureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_nourriture_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $nourriture = new Nourriture();
        $form = $this->createForm(NourritureType::class, $nourriture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($nourriture);
            $entityManager->flush();

            return $this->redirectToRoute('app_nourriture_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('nourriture_crud/new.html.twig', [
            'nourriture' => $nourriture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nourriture_crud_show', methods: ['GET'])]
    public function show(Nourriture $nourriture): Response
    {
        return $this->render('nourriture_crud/show.html.twig', [
            'nourriture' => $nourriture,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_nourriture_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Nourriture $nourriture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NourritureType::class, $nourriture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_nourriture_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('nourriture_crud/edit.html.twig', [
            'nourriture' => $nourriture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nourriture_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Nourriture $nourriture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nourriture->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($nourriture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_nourriture_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
