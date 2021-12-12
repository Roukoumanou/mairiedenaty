<?php

namespace App\Controller\Administrator;

use App\Repository\ArticlesLikesRepository;
use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CommentesLikesRepository;
use App\Repository\CommentesRepository;
use App\Repository\PrestationsRepository;
use App\Repository\ServicesRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AdminHomeController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home", methods={"GET"})
     *
     * @param ArticlesRepository $articlesRepository
     * @param ArticlesLikesRepository $articlesLikesRepository
     * @param UserRepository $userRepository
     * @param CategoriesRepository $categoriesRepository
     * @param CommentesRepository $commentesRepository
     * @param CommentesLikesRepository $commentesLikesRepository
     * @param PrestationsRepository $prestationsRepository
     * @param ServicesRepository $servicesRepository
     * @return Response
     */
    public function index(
        ArticlesRepository $articlesRepository,
        ArticlesLikesRepository $articlesLikesRepository,
        UserRepository $userRepository,
        CategoriesRepository $categoriesRepository,
        CommentesRepository $commentesRepository,
        CommentesLikesRepository $commentesLikesRepository,
        PrestationsRepository $prestationsRepository,
        ServicesRepository $servicesRepository
    ): Response {
        return $this->render('admin/index.html.twig', [
            'articles' => $articlesRepository->count([]),
            'articlesLikes' => $articlesLikesRepository->count([]),
            'users' => $userRepository->count([]),
            'categories' => $categoriesRepository->count([]),
            'commentes' => $commentesRepository->count([]),
            'commentesLikes' => $commentesLikesRepository->count([]),
            'prestations' => $prestationsRepository->count([]),
            'services' => $servicesRepository->count([])
        ]);
    }
}
