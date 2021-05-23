<?php

namespace App\Controller\Administrator;

use App\Entity\Articles;
use App\Form\ArticleFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AdminArticleNewController extends AbstractController
{
    /**
     * @Route("/admin/article/new", name="admin_article_new", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $article = new Articles();

        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($article->getPublishedAt() < new \DateTime()) {
                $this->addFlash(
                    'danger',
                    'La Date de publication doit être dans le future!'
                );

                return $this->redirectToRoute('admin_home');
            }
            $article->setAuthor($this->getUser());

            $em->persist($article);
            $em->flush();

            $this->addFlash(
                'success',
                'Article Enrégistré!'
            );

            return $this->redirectToRoute('admin_home');
        }
        return $this->render('admin/articles/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
