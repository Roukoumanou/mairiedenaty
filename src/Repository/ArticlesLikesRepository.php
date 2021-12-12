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
}
