<?php

namespace App\Controller\Administrator;

use App\Repository\ArticlesLikesRepository;
use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CommentesLikesRepository;
use App\Repository\CommentesRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AdminHomeController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home", methods={"GET"})
     *
     * @return Response
     */
    public function index(
        ArticlesRepository $articlesRepository,
        ArticlesLikesRepository $articlesLikesRepository,
        UserRepository $userRepository,
        CategoriesRepository $categoriesRepository,
        CommentesRepository $commentesRepository,
        CommentesLikesRepository $commentesLikesRepository
    ): Response {
        return $this->render('admin/index.html.twig', [
            'articles' => $articlesRepository->count([]),
            'articlesLikes' => $articlesLikesRepository->count([]),
            'users' => $userRepository->count([]),
            'categories' => $categoriesRepository->count([]),
            'commentes' => $commentesRepository->count([]),
            'commentesLikes' => $commentesLikesRepository->count([])
        ]);
    }
}
