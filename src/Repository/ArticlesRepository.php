<?php

namespace App\Repository;

use App\Entity\Articles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Articles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articles[]    findAll()
 * @method Articles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articles::class);
    }

    private function getQuery()
    {
        $now = new \DateTime();
        $query = $this->createQueryBuilder('a')
            ->leftJoin('a.category', 'c')
            ->andWhere('a.status = :stat')
            ->andWhere('a.publishedAt <= :now')
            ->setParameter('stat', 'public')
            ->setParameter('now', $now);

        return $query;
    }

    /**
     * @return Articles[] Returns an array of Articles objects
     *
     * @param string $name
     */
    public function findByCategory($name): array
    {
        return $this->getQuery()
            ->andWhere('c.name = :val')
            ->setParameter('val', $name)
            ->orderBy('a.publishedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Articles[]
     */
    public function findForIndex(): array
    {
        return $this->getQuery()
            ->orderBy('a.publishedAt', 'DESC')
            ->setMaxResults(12)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Articles[] Returns an array of Articles objects
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
    public function findOneBySomeField($value): ?Articles
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
