<?php

namespace App\Repository;

use App\Entity\Createquizz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Createquizz|null find($id, $lockMode = null, $lockVersion = null)
 * @method Createquizz|null findOneBy(array $criteria, array $orderBy = null)
 * @method Createquizz[]    findAll()
 * @method Createquizz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreatequizzRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Createquizz::class);
    }

    // /**
    //  * @return Createquizz[] Returns an array of Createquizz objects
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
    public function findOneBySomeField($value): ?Createquizz
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
