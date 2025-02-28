<?php

namespace App\Controller;

use App\Entity\Horaires;
use App\Form\HorairesType;
use App\Repository\HorairesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/horaires/crud')]
final class HorairesCrudController extends AbstractController
{
    #[Route(name: 'app_horaires_crud_index', methods: ['GET'])]
    public function index(HorairesRepository $horairesRepository): Response
    {
        return $this->render('horaires_crud/index.html.twig', [
            'horaires' => $horairesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_horaires_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $horaire = new Horaires();
        $form = $this->createForm(HorairesType::class, $horaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($horaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_horaires_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('horaires_crud/new.html.twig', [
            'horaire' => $horaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_horaires_crud_show', methods: ['GET'])]
    public function show(Horaires $horaire): Response
    {
        return $this->render('horaires_crud/show.html.twig', [
            'horaire' => $horaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_horaires_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Horaires $horaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HorairesType::class, $horaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_horaires_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('horaires_crud/edit.html.twig', [
            'horaire' => $horaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_horaires_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Horaires $horaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$horaire->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($horaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_horaires_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
