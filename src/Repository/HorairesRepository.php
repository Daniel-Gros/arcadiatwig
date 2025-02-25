<?php

namespace App\Repository;

use App\Entity\Horaires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Horaires>
 */
class HorairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Horaires::class);
    }

    public function findValidHoraires(): array
    {
        return $this->createQueryBuilder('h')
            ->where('h.open IS NOT NULL')
            ->andWhere('h.close IS NOT NULL')
            ->getQuery()
            ->getResult();
    }
}
