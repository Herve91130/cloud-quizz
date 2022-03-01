<?php

namespace App\Repository;

use App\Entity\JeuxQuizz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method JeuxQuizz|null find($id, $lockMode = null, $lockVersion = null)
 * @method JeuxQuizz|null findOneBy(array $criteria, array $orderBy = null)
 * @method JeuxQuizz[]    findAll()
 * @method JeuxQuizz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JeuxQuizzRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JeuxQuizz::class);
    }

    // /**
    //  * @return JeuxQuizz[] Returns an array of JeuxQuizz objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JeuxQuizz
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
