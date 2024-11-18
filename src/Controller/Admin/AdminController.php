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
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminController extends AbstractController
{
    private AuthorizationCheckerInterface $authChecker;
    private AnimalRepository $animalRepository;
    private HabitatRepository $habitatRepository;
    private CommentaireHabitatRepository $commentaireHabitatRepository;
    private CompteRenduVeterinaireRepository $compteRenduVeterinaireRepository;
    private ServiceRepository $serviceRepository;
    private AvisRepository $avisRepository;

    public function __construct(
        AuthorizationCheckerInterface $authChecker,
        AnimalRepository $animalRepository,
        HabitatRepository $habitatRepository,
        CommentaireHabitatRepository $commentaireHabitatRepository,
        CompteRenduVeterinaireRepository $compteRenduVeterinaireRepository,
        ServiceRepository $serviceRepository,
        AvisRepository $avisRepository
    ) {
        $this->authChecker = $authChecker;
        $this->animalRepository = $animalRepository;
        $this->habitatRepository = $habitatRepository;
        $this->commentaireHabitatRepository = $commentaireHabitatRepository;
        $this->compteRenduVeterinaireRepository = $compteRenduVeterinaireRepository;
        $this->serviceRepository = $serviceRepository;
        $this->avisRepository = $avisRepository;
    }

    #[Route('/admin', name: 'app_admin')]

    public function index(): Response
    {
        $animalCount = $this->animalRepository->count([]);
        $habitatCount = $this->habitatRepository->count([]);
        $commentaireHabitatCount = $this->commentaireHabitatRepository->count([]);
        $compteRenduVeterinaireCount = $this->compteRenduVeterinaireRepository->count([]);
        $serviceCount = $this->serviceRepository->count([]);
        $avisCount = $this->avisRepository->count([]);

        return $this->render('admin/dashboard/index.html.twig', [
            'animalCount' => $animalCount,
            'habitatCount' => $habitatCount,
            'commentaireHabitatCount' => $commentaireHabitatCount,
            'compteRenduVeterinaireCount' => $compteRenduVeterinaireCount,
            'serviceCount' => $serviceCount,
            'avisCount' => $avisCount,
        ]);
    }
}
