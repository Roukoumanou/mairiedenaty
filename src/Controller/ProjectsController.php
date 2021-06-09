<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ProjectsController extends AbstractController
{
    /**
     * @Route("/projets", name="projects", methods={"GET"})
     */
    public function projects(ArticlesRepository $articlesRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $news = $paginator->paginate(
            $articlesRepository->findByCategory('projets'), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('articles/projects/projects.html.twig', [
            'news' => $news,
        ]);
    }
}
