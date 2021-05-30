<?php

namespace App\Repository;

use App\Entity\Createquizz2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Createquizz2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Createquizz2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Createquizz2[]    findAll()
 * @method Createquizz2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Createquizz2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Createquizz2::class);
    }

    // /**
    //  * @return Createquizz2[] Returns an array of Createquizz2 objects
    //  */
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
    public function findOneBySomeField($value): ?Createquizz2
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