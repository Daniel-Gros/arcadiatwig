<?php

namespace App\Controller\Admin;

use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use App\Repository\ServiceRepository;
use App\Repository\AvisRepository;
use App\Repository\CommentaireHabitatRepository;
use App\Repository\CompteRenduVeterinaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    #[IsGranted('ROLE_ADMIN')]


    public function index(
        AnimalRepository $animalRepository,
        HabitatRepository $habitatRepository,
        CommentaireHabitatRepository $commentaireHabitatRepository,
        CompteRenduVeterinaireRepository $compteRenduVeterinaireRepository,
        ServiceRepository $serviceRepository,
        AvisRepository $avisRepository
    ): Response {

        $animalCount = $animalRepository->count([]);
        $habitatCount = $habitatRepository->count([]);
        $commentaireHabitatCount = $commentaireHabitatRepository->count([]);
        $compteRenduVeterinaireCount = $compteRenduVeterinaireRepository->count([]);
        $serviceCount = $serviceRepository->count([]);
        $avisCount = $avisRepository->count([]);

        return $this->render('admin/dashboard/index.html.twig', [
            'controller_name' => 'AdminController',
            'animalCount' => $animalCount,
            'habitatCount' => $habitatCount,
            'commentaireHabitatCount' => $commentaireHabitatCount,
            'compteRenduVeterinaireCount' => $compteRenduVeterinaireCount,
            'serviceCount' => $serviceCount,
            'avisCount' => $avisCount,
        ]);
    }
}
