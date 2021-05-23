<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    /**
     * Acceuil
     * @Route("/", name="home", methods={"GET"})
     *
     * @return Response
     */
    public function index(ArticlesRepository $articlesRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $news = $paginator->paginate(
            $articlesRepository->findForIndex(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );
        //return $this->render('lunch.html.twig');
        return $this->render('home/index.html.twig', [
            'news' => $news,
        ]);
    }
}
