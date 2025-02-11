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
        $this->entityManager = $entityManager;
        $this->habitatRepository = $habitatRepository;
        $this->animalRepository = $animalRepository;
    }

    #[Route('/animal/{id}', name: 'app_animal_show')]
    public function showAnimal(int $id): Response
    {
        $animal = $this->animalRepository->find($id);

        if (!$animal) {
            throw $this->createNotFoundException('Animal non trouvé');
        }

        return $this->render('animal/select_animal.html.twig', [
            'animal' => $animal,
        ]);
    }


    #[Route('/', name: 'app_home')]


    public function index(Request $request, ParameterBagInterface $parameterBagInterface): Response
    {
        $habitats = $this->habitatRepository->findAll();

        $limit = $parameterBagInterface->get('animal_homepage_limit');
        $animals = $this->animalRepository->findBy([], ['id' => 'DESC'], $limit);

        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);

        $approvedAvis = $this->entityManager->getRepository(Avis::class)->findBy(['status' => 'approved']);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $avis->setUserId($this->getUser());
            $avis->setValidation(false);
            $this->entityManager->persist($avis);
            try {
                $this->entityManager->flush();
            } catch (\Doctrine\DBAL\Exception\DriverException $e) {
                dd ($e->getMessage());
                $this->addFlash('error', 'Une erreur est survenue lors de l\'ajout de votre avis');
            }

            return $this->redirectToRoute('app_home');
        }


        return $this->render('home/index.html.twig', [
            'mentions_legales_path' => $this->generateUrl('app_mentions_legales'),
            'website' => 'Arcadia',
            'habitats' => $habitats,
            'animals' => $animals,
            'form' => $form->createView(),
            'avis' => $approvedAvis,
        ]);
    }
}
