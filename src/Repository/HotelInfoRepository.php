<?php

namespace App\Repository;

use App\Entity\HotelInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HotelInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method HotelInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method HotelInfo[]    findAll()
 * @method HotelInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotelInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HotelInfo::class);
    }

    // /**
    //  * @return HotelInfo[] Returns an array of HotelInfo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HotelInfo
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
