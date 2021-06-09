<?php

namespace App\Repository;

use App\Entity\ArticlesLikes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticlesLikes|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticlesLikes|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticlesLikes[]    findAll()
 * @method ArticlesLikes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesLikesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticlesLikes::class);
    }

    // /**
    //  * @return ArticlesLikes[] Returns an array of ArticlesLikes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArticlesLikes
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
