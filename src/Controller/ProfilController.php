<?php

namespace App\Controller;

use App\Repository\CommentesRepository;
use App\Repository\ArticlesLikesRepository;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\CommentesLikesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/profil")
 */
final class ProfilController extends AbstractController
{
    protected $paginator;

    public function __construct(PaginatorInterface $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * @Route("/", name="profil", methods={"GET"})
     *
     * @return Response
     */
    public function myProfil(): Response
    {
        return $this->render('profil/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/articles-likes", name="articles_likes", methods={"GET"})
     *
     * @param ArticlesLikesRepository $articlesLikesRepository
     * @param Request $request
     * @return Response
     */
    public function adLike(ArticlesLikesRepository $articlesLikesRepository, Request $request): Response
    {
        $articlesLikes = $this->paginator->paginate(
            $articlesLikesRepository->findBy(['author' => $this->getUser()], ['createdAt' => 'DESC']),
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('profil/articles_likes.html.twig', [
            'articlesLikes' => $articlesLikes,
        ]);
    }

    /**
     * @Route("/my-commentes", name="my_commentes", methods={"GET"})
     *
     * @param CommentesRepository $commentesRepository
     * @param Request $request
     * @return Response
     */
    public function myCommente(CommentesRepository $commentesRepository, Request $request): Response
    {
        $commentes = $this->paginator->paginate(
            $commentesRepository->findBy(['author' => $this->getUser()], ['createdAt' => 'DESC']),
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('profil/my_commentes.html.twig', [
            'commentes' => $commentes,
        ]);
    }

    /**
     * @Route("/my-commentes-likes", name="my_commentes_likes", methods={"GET"})
     *
     * @param CommentesLikesRepository $commentesLikesRepository
     * @param Request $request
     * @return Response
     */
    public function myCommenteLike(CommentesLikesRepository $commentesLikesRepository, Request $request): Response
    {
        $commentesLikes = $this->paginator->paginate(
            $commentesLikesRepository->findBy(['author' => $this->getUser()], ['createdAt' => 'DESC']),
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('profil/commentes_likes.html.twig', [
            'commentesLikes' => $commentesLikes,
        ]);
    }
}
