<?php

namespace App\Repository;

use App\Entity\Nourrissage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Nourrissage>
 */
class NourrissageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nourrissage::class);
    }
    public function findAllWithAnimal(): array
    {
        return $this->createQueryBuilder('n')
            ->leftJoin('n.animal', 'a')  
            ->addSelect('a')             
            ->getQuery()
            ->getResult();
    }
}
