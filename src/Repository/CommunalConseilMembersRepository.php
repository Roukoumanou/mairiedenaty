<?php

namespace App\Repository;

use App\Entity\CommunalConseilMembers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommunalConseilMembers|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommunalConseilMembers|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommunalConseilMembers[]    findAll()
 * @method CommunalConseilMembers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommunalConseilMembersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommunalConseilMembers::class);
    }

    /**
     * @return CommunalConseilMembers[] Returns an array of CommunalConseilMembers objects
     */
    public function getMaire()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.poste = :val')
            ->setParameter('val', 'maire')
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return CommunalConseilMembers[]
     */
    public function getAdjoints()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.poste = :val')
            ->setParameter('val', 'adjoints_au_maire')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return CommunalConseilMembers
     */
    public function getCaef()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.poste = :val')
            ->setParameter('val', 'caef')
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return CommunalConseilMembers[]
     */
    public function getCAs()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.poste = :val')
            ->setParameter('val', 'c.as')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return CommunalConseilMembers Returns an array of CommunalConseilMembers objects
     */
    public function getCasc()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.poste = :val')
            ->setParameter('val', 'casc')
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return CommunalConseilMembers Returns an array of CommunalConseilMembers objects
     */
    public function getPlaintes()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.poste = :val')
            ->setParameter('val', 'plaintes')
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return CommunalConseilMembers Returns an array of CommunalConseilMembers objects
     */
    public function getCade()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.poste = :val')
            ->setParameter('val', 'cade')
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return CommunalConseilMembers[]
     */
    public function getCcs()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.poste = :val')
            ->setParameter('val', 'c.cs')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?CommunalConseilMembers
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
