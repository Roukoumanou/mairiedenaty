<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class InfosController extends AbstractController
{
    /**
     * @Route("/infos", name="infos", methods={"GET"})
     */
    public function infos(ArticlesRepository $articlesRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $news = $paginator->paginate(
            $articlesRepository->findByCategory('Informations'), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );
        return $this->render('articles/infos/infos.html.twig', [
            'news' => $news,
        ]);
    }
}
