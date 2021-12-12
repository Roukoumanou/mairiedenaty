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
}
