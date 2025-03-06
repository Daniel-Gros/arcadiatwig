<?php

namespace App\Repository;

use App\Entity\CompteRenduVeterinaire;
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
        $queryBuilder = $this->createQueryBuilder('c')
            ->leftJoin('c.animal_id', 'a')
            ->addSelect('a');

        if ($animal) {
            $queryBuilder->join('c.animal_id', 'a')
                ->andWhere('a.firstName LIKE :animal')
                ->setParameter('animal', '%' . $animal . '%');
        }

        if ($date) {
            $queryBuilder->andWhere('DATE(c.date) = :date')
                ->setParameter('date', $date);
        }

        return $queryBuilder->getQuery()->getResult();
    }
}
