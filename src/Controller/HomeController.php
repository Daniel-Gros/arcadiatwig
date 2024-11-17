<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $entityManager;
    private $habitatRepository;
    private $animalRepository;

    public function __construct(EntityManagerInterface $entityManager, HabitatRepository $habitatRepository, AnimalRepository $animalRepository)
    {
        $this->habitatRepository = $habitatRepository;
        $this->animalRepository = $animalRepository;
    }

    #[Route('/', name: 'app_home')]
    public function index(Request $request, ParameterBagInterface $parameterBagInterface): Response
    {
        $habitats = $this->habitatRepository->findAll();

        $limit = $parameterBagInterface->get('animal_homepage_limit');
        $animals = $this->animalRepository->findBy([], ['id' => 'DESC'], $limit);

        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $avis->setUserId($this->getUser()); 
            $this->entityManager->persist($avis);
            $this->entityManager->flush();


            return $this->redirectToRoute('app_home');
        }


        return $this->render('home/index.html.twig', [
            'website' => 'Arcadia',
            'habitats' => $habitats,
            'animals' => $animals,
            'form' => $form->createView(), 
            'controller_name' => 'HomeController',
        ]);
    }
}
