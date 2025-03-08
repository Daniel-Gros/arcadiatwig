<?php

namespace App\Repository;

use App\Entity\CompteRenduVeterinaire;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompteRenduVeterinaire>
 */
class CompteRenduVeterinaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompteRenduVeterinaire::class);
    }

    public function findByFilter(?string $animal, ?string $date)
    {
        $qb = $this->createQueryBuilder('c')
            ->leftJoin('c.animal_id', 'a')
            ->addSelect('a');

        if ($date) {
            $date = new DateTime($date);

            $qb->where('c.date BETWEEN :fromDate AND :toDate')
                ->setParameter('fromDate', $date->format("Y-m-d")." 00:00:00")
                ->setParameter('toDate', $date->format("Y-m-d")." 23:59:59");
        }

        if ($animal) {
            $qb->andWhere('a.firstName = :animalName')
                ->setParameter('animalName', $animal);
        }

        return $qb->getQuery()->getResult();
    }
}
