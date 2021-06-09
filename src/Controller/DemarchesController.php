<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DemarchesController extends AbstractController
{
    /**
     * @Route("/demarches", name="demarches", methods={"GET"})
     */
    public function mesDemarches(ArticlesRepository $articlesRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $news = $paginator->paginate(
            $articlesRepository->findByCategory('demarches'), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('articles/demarches/demarches.html.twig', [
            'news' => $news,
        ]);
    }
}
