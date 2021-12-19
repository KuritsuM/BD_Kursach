<?php

namespace App\Repository;

use App\Entity\IngridientsOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IngridientsOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method IngridientsOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method IngridientsOrder[]    findAll()
 * @method IngridientsOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngridientsOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IngridientsOrder::class);
    }

    // /**
    //  * @return IngridientsOrder[] Returns an array of IngridientsOrder objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IngridientsOrder
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
