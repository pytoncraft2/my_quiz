<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @method Reponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reponse[]    findAll()
 * @method Reponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reponse::class);
    }

    public function findAllAskedOrderedByNewest($categorie,$question)
    {
    $query = $this->createQueryBuilder('question');
    $query->innerJoin(
      Reponse::class,    // Entity
      'p',               // Alias
      Join::WITH,        // Join type
      'p.id = question.id' // Join columns
  );
        return $query->getQuery()->getResult();
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
