<?php

namespace App\Repository;

use App\Entity\ProduitBoutique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProduitBoutique|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitBoutique|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitBoutique[]    findAll()
 * @method ProduitBoutique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitBoutiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProduitBoutique::class);
    }

    // /**
    //  * @return ProduitBoutique[] Returns an array of ProduitBoutique objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProduitBoutique
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
