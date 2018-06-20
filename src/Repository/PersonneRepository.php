<?php

namespace App\Repository;

use App\Entity\Personne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Personne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personne[]    findAll()
 * @method Personne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonneRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Personne::class);
    }

    public function search(?string $q = null)
    {
        //Version avec QueryBuilder
        $qb = $this->createQueryBuilder('d');

        if(!empty($q)){
            $qb->andWhere('d.firstname LIKE :q
                OR d.lastname LIKE :q 
                OR d.email LIKE :q');
            $qb->setParameter("q", '%' . $q . '%');
        }

        $qb->addOrderBy("d.lastname", "DESC");

        //jointure pour récupérer les reviews en même temps
        //$qb->leftJoin('d.reviews', 'r');
        //$qb->addSelect('r');

        $query = $qb->getQuery();

        /*
        //Version avec DQL
        $dql = "SELECT m
                FROM App\Entity\Movie m
                WHERE m.title LIKE :q
                OR m.actors LIKE :q
                OR m.directors LIKE :q";

        $query = $this->getEntityManager()->createQuery($dql)
        */
        $query->setMaxResults(30);
        $results = $query->getResult();

        return $results;
    }
}

