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

    public function randomDoudous($num)
    {
        //récupère tous les ids de la table
        $qb = $this->createQueryBuilder('d');
        $qb->select('d.id');
        $idsTemp = $qb->getQuery()->getScalarResult();
        $ids = array_column($idsTemp, "id");

        //récupère x ids au hasard depuis le tableau des ids
        shuffle($ids);
        $randomIds = array_slice($ids, 0, $num);

        //récupère les objets Doudous associés à ces ids
        $qb = $this->createQueryBuilder('d');
        $qb->select('d')->where('d.id IN (:ids)')
            ->setParameter('ids', $randomIds);
        $doudou = $qb->getQuery()->getResult();
        shuffle($doudou);
        return $doudou;
    }

    public function search(?string $q = null)
    {
        //Version avec QueryBuilder
        $qb = $this->createQueryBuilder('d');

        if(!empty($q)){
            $qb->andWhere('d.id LIKE :q
                OR d.Couleur LIKE :q 
                OR d.lieuDecouverte LIKE :q
                OR t.label LIKE :q');
            $qb->setParameter("q", '%' . $q . '%');
        }

        $qb->addOrderBy("d.id", "DESC");

        //jointure pour récupérer le type en même temps
        $qb->leftJoin('d.type', 't');
        $qb->addSelect('t');

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
