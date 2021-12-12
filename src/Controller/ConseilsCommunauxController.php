<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ConseilsCommunauxController extends AbstractController
{
    /**
     * @Route("/conseils-communaux", name="conseils_communaux", methods={"GET"})
     */
    public function conseilsCommunaux(ArticlesRepository $articlesRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $news = $paginator->paginate(
            $articlesRepository->findByCategory(Articles::CATEGORIE_CONSEIL_COMMUNAL), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('articles/conseils/conseils.html.twig', [
            'news' => $news,
        ]);
    }
}
