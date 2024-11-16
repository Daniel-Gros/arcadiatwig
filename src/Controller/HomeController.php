<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {

        $website = 'Arcadia';
        return $this->render('home/index.html.twig', [
            // 'navItems' => $navItems,
            'website' => $website,
            'controller_name' => 'HomeController',
        ]);
    }



    #[Route('/', name: 'app_home')]
    public function habitatRequest (HabitatRepository $habitatRepository): Response
    {
        $habitats = $habitatRepository->findAll();

        return $this->render('home/index.html.twig', [
            'habitats' => $habitats,
        ]);
    }


    #[Route('/', name: 'app_home')]
    public function animalRequest (AnimalRepository $animalRepository): Response
    {
        $animals = $animalRepository->findAll();

        return $this->render('home/index.html.twig', [
            'animals' => $animals,
        ]);
    }

    #[Route('/', name: 'app_home')]
    public function new(Request $request): Response
    {
        if ($this->isGranted('ROLE_EMPLOYEE')) {
            return $this->redirectToRoute('home');
        }


        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $avis->setUser($this->getUser());
        }
        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    
}
