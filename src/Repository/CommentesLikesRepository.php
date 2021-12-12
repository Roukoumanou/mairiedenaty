<?php

namespace App\Repository;

use App\Entity\CommentesLikes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommentesLikes|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentesLikes|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentesLikes[]    findAll()
 * @method CommentesLikes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentesLikesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentesLikes::class);
    }
}
