<?php

namespace App\Repository;

use App\Entity\ThemeQuizz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ThemeQuizz|null find($id, $lockMode = null, $lockVersion = null)
 * @method ThemeQuizz|null findOneBy(array $criteria, array $orderBy = null)
 * @method ThemeQuizz[]    findAll()
 * @method ThemeQuizz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThemeQuizzRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ThemeQuizz::class);
    }

    // /**
    //  * @return ThemeQuizz[] Returns an array of ThemeQuizz objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ThemeQuizz
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
