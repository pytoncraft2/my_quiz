<?php

namespace App\Repository;

use App\Entity\Quiz;
use App\Entity\Reponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reponse[]    findAll()
 * @method Reponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quiz::class);
    }

    public function findAllAskedOrderedByNewest($start, $cat)
    {
        return $this->createQueryBuilder('reponse')
        ->innerJoin('App\Entity\Quiz', 'u', Join::WITH, 'u = reponse.id')
            ->andWhere("u.idCategorie = $cat")
            ->setFirstResult($start)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findAllAskedOrderedByNewest2($start, $cat)
    {
      // dump($start);
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            "SELECT p
              FROM App\Entity\Reponse p, App\Entity\Quiz c
              WHERE c.idCategorie = $cat AND p.idQuestion = c.id")
             ->setFirstResult($start * 3)
             ->setMaxResults(3);

        return $query->getResult();
    }

    // /**
    //  * @return Reponse[] Returns an array of Reponse objects
    //  */
    /*
    public function findByExampleField($value)
    {
    $entityManager = $this->getEntityManager();

    $query = $entityManager->createQuery(
    'SELECT p, c
    FROM App\Entity\Product p
    INNER JOIN p.category c
    WHERE p.id = :id'
)->setParameter('id', $productId);

return $query->getOneOrNullResult();
    }
    */


    /*
    public function findOneBySomeField($value): ?Reponse
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
