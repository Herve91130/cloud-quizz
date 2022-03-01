<?php

namespace App\Repository;

use App\Entity\QuestionQuizz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuestionQuizz|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionQuizz|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionQuizz[]    findAll()
 * @method QuestionQuizz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionQuizzRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionQuizz::class);
    }

    // /**
    //  * @return QuestionQuizz[] Returns an array of QuestionQuizz objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuestionQuizz
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
