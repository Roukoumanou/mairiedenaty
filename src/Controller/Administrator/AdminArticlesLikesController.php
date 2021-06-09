<?php

namespace App\Controller\Administrator;

use App\Repository\ArticlesLikesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AdminArticlesLikesController extends AbstractController
{
    /**
     * @Route("/admin/articles/likes", name="admin_articles_likes", methods={"GET"})
     */
    public function index(ArticlesLikesRepository $articlesLikesRepository): Response
    {
        return $this->render('admin/articles/likes.html.twig', [
            'likes' => $articlesLikesRepository->count([]),
        ]);
    }
}
