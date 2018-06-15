<?php

namespace App\Repository;

use App\Entity\CoordGPS;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CoordGPS|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoordGPS|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoordGPS[]    findAll()
 * @method CoordGPS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoordGPSRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CoordGPS::class);
    }

//    /**
//     * @return CoordGPS[] Returns an array of CoordGPS objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CoordGPS
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
