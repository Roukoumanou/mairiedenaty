<?php

namespace App\Repository;

use App\Entity\Commentes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commentes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentes[]    findAll()
 * @method Commentes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentes::class);
    }

    /**
     * @return Commentes[] Returns an array of Commentes objects
     */
    public function findByArticleId($value)
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.article', 'a')
            ->andWhere('a.id = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
}
