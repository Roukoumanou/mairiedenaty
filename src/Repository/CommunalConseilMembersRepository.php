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
     * @return CommunalConseilMembers Returns an array of CommunalConseilMembers objects
     */
    public function getMaire()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.poste = :val')
            ->setParameter('val', CommunalConseilMembers::MAIRE)
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
            ->setParameter('val', CommunalConseilMembers::ADJOINTS_AU_MAIRE)
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
            ->setParameter('val', CommunalConseilMembers::PDT_CAEF)
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
            ->setParameter('val', CommunalConseilMembers::C_A)
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
            ->setParameter('val', CommunalConseilMembers::PDTE_CASC)
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
            ->setParameter('val', CommunalConseilMembers::PDT_COM_PLAINTES)
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
            ->setParameter('val', CommunalConseilMembers::PDT_CADE)
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
            ->setParameter('val', CommunalConseilMembers::CONSEILLERS_COMMUNAL)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
