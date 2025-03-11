<?php

namespace App\Controller;

use App\Entity\CompteRenduVeterinaire;
use App\Form\CompteRenduFilterType;
use App\Form\CompteRenduVeterinaireType;
use App\Repository\AnimalRepository;
use App\Repository\CompteRenduVeterinaireRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CompteRenduVeterinaireCrudController extends AbstractController
{
    #[Route(path:'/compte/rendu/veterinaire/crud', name: 'app_compte_rendu_veterinaire_crud_index', methods: ['POST', 'GET'])]
    public function index(CompteRenduVeterinaireRepository $compteRenduVeterinaireRepository, AnimalRepository $animalRepository): Response
    {
        $form = $this->createForm(CompteRenduFilterType::class);

        return $this->render('compte_rendu_veterinaire_crud/index.html.twig', [
            'animal' => array_map(function ($animal) {
                return ['firstName' => $animal->getFirstName()];
            }, $animalRepository->findAll()),
            'compte_rendu_veterinaires' => $compteRenduVeterinaireRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    #[Route(path:'/compte/rendu/veterinaire/crud/new', name: 'app_compte_rendu_veterinaire_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $compteRenduVeterinaire = new CompteRenduVeterinaire();
        $form = $this->createForm(CompteRenduVeterinaireType::class, $compteRenduVeterinaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($compteRenduVeterinaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_compte_rendu_veterinaire_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('compte_rendu_veterinaire_crud/new.html.twig', [
            'compte_rendu_veterinaire' => $compteRenduVeterinaire,
            'form' => $form,
        ]);
    }

    #[Route(path:'/compte/rendu/veterinaire/show/{compteRenduVeterinaire}', name: 'app_compte_rendu_veterinaire_crud_show', methods: ['GET'])]
    public function show(CompteRenduVeterinaire $compteRenduVeterinaire): Response
    {
        return $this->render('compte_rendu_veterinaire_crud/show.html.twig', [
            'compte_rendu_veterinaire' => $compteRenduVeterinaire,
        ]);
    }

    #[Route(path:'/compte/rendu/veterinaire/edit/{compteRenduVeterinaire}', name: 'app_compte_rendu_veterinaire_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CompteRenduVeterinaire $compteRenduVeterinaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CompteRenduVeterinaireType::class, $compteRenduVeterinaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_compte_rendu_veterinaire_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('compte_rendu_veterinaire_crud/edit.html.twig', [
            'compte_rendu_veterinaire' => $compteRenduVeterinaire,
            'form' => $form,
        ]);
    }

    #[Route(path:'/compte/rendu/veterinaire/delete/{compteRenduVeterinaire}', name: 'app_compte_rendu_veterinaire_crud_delete', methods: ['POST'])]
    public function delete(Request $request, CompteRenduVeterinaire $compteRenduVeterinaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $compteRenduVeterinaire->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($compteRenduVeterinaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_compte_rendu_veterinaire_crud_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route(path:'/compte/rendu/veterinaire/crud/filter', name: 'app_compte_rendu_veterinaire_crud_filter', methods: ['POST'])]
    public function filter(Request $request, CompteRenduVeterinaireRepository $compteRenduVeterinaireRepository): Response
    {
        $animalName = $request->get("compte_rendu_filter")['animal'] ?? null;   
        $date = $request->get("compte_rendu_filter")['date'] ?? new DateTime();

        $animalName = $animalName !== "" ? $animalName : null;

        $compteRenduVeterinaires = $compteRenduVeterinaireRepository->findByFilter($animalName, $date);

        return $this->render('compte_rendu_veterinaire_crud/index.html.twig', [
            'compte_rendu_veterinaires' => $compteRenduVeterinaires,
            'form' => $this->createForm(CompteRenduFilterType::class)->createView(),
        ]);
    }
}
