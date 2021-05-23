<?php

namespace App\Controller\Administrator;

use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AdminArticleListController extends AbstractController
{
    /**
     * @Route("/admin/articles", name="admin_article_list", methods={"GET"})
     *
     * @param ArticlesRepository $articlesRepository
     * @return Response
     */
    public function index(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('admin/articles/index.html.twig', [
            'articles' => $articlesRepository->findAll(),
        ]);
    }
}
