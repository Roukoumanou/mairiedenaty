<?php

namespace App\Controller;

use SocialLinks\Page;
use App\Entity\Articles;
use App\Entity\Commentes;
use App\Form\CommentesType;
use App\Repository\CommentesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class ArticleShowController extends AbstractController
{
    /**
     * @Route("/article/{id}/{slug}", name="article_show", methods={"GET", "POST"})
     */
    public function show(Articles $article, Request $request, EntityManagerInterface $em): Response
    {
        $commente = new Commentes();
        $form = $this->createForm(CommentesType::class, $commente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commente->setAuthor($this->getUser())
                ->setArticle($article);

            $em->persist($commente);
            $em->flush();

            $this->addFlash(
                'success',
                "Votre commentaire a été ajouté!"
            );

            return $this->redirectToRoute('article_show', [
                'slug' => $article->getSlug(),
                'id' => $article->getId()
            ]);
        }

        return $this->render('articles/show.html.twig', [
            'new' => $article,
            'form' =>  $form->createView(),
        ]);
    }
}
