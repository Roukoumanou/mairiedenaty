<?php

namespace App\Repository;

use App\Entity\CommenteReponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommenteReponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommenteReponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommenteReponse[]    findAll()
 * @method CommenteReponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommenteReponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommenteReponse::class);
    }

    // /**
    //  * @return CommenteReponse[] Returns an array of CommenteReponse objects
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
    public function findOneBySomeField($value): ?CommenteReponse
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
