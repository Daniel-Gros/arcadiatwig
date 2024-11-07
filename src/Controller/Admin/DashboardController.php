<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/admin/dashboard', name: 'app_admin_dashboard')]
    public function index(): Response
    {

        $animalRoute = $this->generateUrl('app_animal_crud_index');
        $habitatRoute = $this->generateUrl('app_habitat_crud_index');
        $avisRoute = $this->generateUrl('app_avis_crud_index');
        $commentaireHabitatRoute = $this->generateUrl('app_commentaire_habitat_crud_index');
        $compteRenduVeterinaireRoute = $this->generateUrl('app_compte_rendu_veterinaire_crud_index');
        $ServicesRoute = $this->generateUrl('app_services_crud_index');
        $userRoute = $this->generateUrl('app_user_crud_index');



        return $this->render('admin/dashboard/index.html.twig', [
            'animalRoute' => $animalRoute,
            'habitatRoute' => $habitatRoute,
            'avisRoute' => $avisRoute,
            'commentaireHabitatRoute' => $commentaireHabitatRoute,
            'compteRenduVeterinaireRoute' => $compteRenduVeterinaireRoute,
            'ServicesRoute' => $ServicesRoute,
        ]);
    }
    
}
