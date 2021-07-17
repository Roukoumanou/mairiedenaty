<?php

namespace App\Controller\Redact;

use App\Entity\Articles;
use App\Form\ArticleFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ArticlesController extends AbstractController
{
    /**
     * @Route("/redact/new-article", name="redact_new_article", methods={"GET", "POST"})
     * @IsGranted("ROLE_REDACTOR")
     *
     * @return Response
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $article = new Articles();

        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $now = new \DateTime();
            if ($article->getPublishedAt() < $now) {
                $this->addFlash(
                    'danger',
                    'La Date de publication doit être dans le future!'
                );

                return $this->redirectToRoute('redact_new_article');
            }
            $article->setAuthor($this->getUser());

            $em->persist($article);
            $em->flush();

            $this->addFlash(
                'success',
                'Article Enrégistré!'
            );

            return $this->redirectToRoute('article_show', [
                'id' => $article->getId(),
                'slug' => $article->getSlug()
            ]);
        }

        return $this->render('redact/articles/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/redact/article/{id}-{slug}", name="redact_edit_article", methods={"GET", "POST"})
     * @IsGranted("ROLE_REDACTOR")
     *
     * @param Articles $article
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function edit(Articles $article, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setUpdatedAt(new \DateTime())
                ->setAuthor($this->getUser());

            $em->flush();

            $this->addFlash(
                'success',
                'Article Modifié!'
            );

            return $this->redirectToRoute('article_show', [
                'id' => $article->getId(),
                'slug' => $article->getSlug()
            ]);
        }

        return $this->render('redact/articles/edit.html.twig', [
            'form' => $form->createView(),
            'article' => $article
        ]);
    }
}
