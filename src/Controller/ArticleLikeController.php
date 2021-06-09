<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\ArticlesLikes;
use App\Repository\ArticlesLikesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ArticleLikeController extends AbstractController
{
    /**
     * @Route("/article/{id}-like", name="article_like")
     */
    public function articleLike(Articles $article, EntityManagerInterface $em, ArticlesLikesRepository $articlesLikesRepository): Response
    {
        $user = $this->getUser();

        if ($article->getIsLikeByUser($user)) {
            $like = $articlesLikesRepository->findOneBy([
                'article' => $article,
                'author' => $user
            ]);

            $em->remove($like);
            $em->flush();

            return $this->json([
                'code' => 200,
                'message' => 'Votre like a été supprimé!',
                'likes' => $articlesLikesRepository->count([
                    'article' => $article
                ])
            ], 200);
        }

        $articleLike = new ArticlesLikes();
        $articleLike->setAuthor($user)
            ->setArticle($article);

        $em->persist($articleLike);
        $em->flush();

        return $this->json([
            'code' => 200,
            'message' => 'Votre like a été ajouté!',
            'likes' => $articlesLikesRepository->count([
                'article' => $article
            ])
        ], 200);
    }
}
