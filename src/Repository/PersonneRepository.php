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

    public function bla(?string $q = null)
    {
        $qb = $this->createQueryBuilder('p');

        /*if(!empty($q)){
            $qb->andWhere('p.firstname LIKE :q
                OR p.lastname LIKE :q 
                OR p.lastname LIKE :q');
            $qb->setParameter("q", '%' . $q . '%');
        }*/

        $qb->addOrderBy("p.lastname", "DESC");

        $query = $qb->getQuery();

        //$query->setMaxResults(30);
        $results = $query->getResult();

        return $results;
    }
}
