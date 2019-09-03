<?php

namespace App\Repository;

use App\Entity\EventTest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EventTest|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventTest|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventTest[]    findAll()
 * @method EventTest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventTestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventTest::class);
    }

    // /**
    //  * @return EventTest[] Returns an array of EventTest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EventTest
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
