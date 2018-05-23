<?php

namespace App\Repository;

use App\Entity\Doudou;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Doudou|null find($id, $lockMode = null, $lockVersion = null)
 * @method Doudou|null findOneBy(array $criteria, array $orderBy = null)
 * @method Doudou[]    findAll()
 * @method Doudou[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoudouRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Doudou::class);
    }

//    /**
//     * @return Doudou[] Returns an array of Doudou objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Doudou
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
