<?php

namespace App\Repository;

use App\Entity\FoodIngridients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FoodIngridients|null find($id, $lockMode = null, $lockVersion = null)
 * @method FoodIngridients|null findOneBy(array $criteria, array $orderBy = null)
 * @method FoodIngridients[]    findAll()
 * @method FoodIngridients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FoodIngridientsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FoodIngridients::class);
    }

    // /**
    //  * @return FoodIngridients[] Returns an array of FoodIngridients objects
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
    public function findOneBySomeField($value): ?FoodIngridients
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
