<?php

namespace App\Repository;

use App\Entity\EmployeeInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmployeeInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmployeeInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmployeeInfo[]    findAll()
 * @method EmployeeInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeeInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmployeeInfo::class);
    }

    // /**
    //  * @return EmployeeInfo[] Returns an array of EmployeeInfo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EmployeeInfo
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
