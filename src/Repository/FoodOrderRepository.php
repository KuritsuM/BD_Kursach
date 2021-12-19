<?php

namespace App\Repository;

use App\Entity\FoodOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FoodOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method FoodOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method FoodOrder[]    findAll()
 * @method FoodOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FoodOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FoodOrder::class);
    }

    // /**
    //  * @return FoodOrder[] Returns an array of FoodOrder objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FoodOrder
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
