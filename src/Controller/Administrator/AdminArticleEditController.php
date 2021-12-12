<?php

namespace App\Controller\Administrator;

use App\Entity\Articles;
use App\Form\ArticleFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AdminArticleEditController extends AbstractController
{
    /**
     * @Route("/admin/article/edit/{id}", name="admin_article_edit", methods={"GET", "POST"})
     *
     * @param Articles $article
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     */
    public function index(Articles $article, EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd($article->getContent());
            $article->setUpdatedAt(new \DateTime());
            $em->flush();

            $this->addFlash(
                'success',
                'Article Modifié!'
            );

            return $this->redirectToRoute('admin_home');
        }
        return $this->render('admin/articles/edit.html.twig', [
            'form' => $form->createView(),
            'article' => $article
        ]);
    }
}
