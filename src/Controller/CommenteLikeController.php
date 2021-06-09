<?php

namespace App\Controller;

use App\Entity\Commentes;
use App\Entity\CommentesLikes;
use App\Repository\CommentesRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CommentesLikesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CommenteLikeController extends AbstractController
{
    /**
     * @Route("/commente/{id}-like", name="commente_like")
     */
    public function like(Commentes $commente, EntityManagerInterface $em, CommentesLikesRepository $commentesLikesRepository): Response
    {
        $user = $this->getUser();

        if ($commente->getIsLikeByUser($user)) {
            $like = $commentesLikesRepository->findOneBy([
                'commente' => $commente,
                'author' => $user
            ]);

            $em->remove($like);
            $em->flush();

            return $this->json([
                'code' => 200,
                'message' => 'Votre like a été supprimé!',
                'likes' => $commentesLikesRepository->count([
                    'commente' => $commente
                ])
            ], 200);
        }

        $commenteLike = new CommentesLikes();
        $commenteLike->setAuthor($user)
            ->setCommente($commente);

        $em->persist($commenteLike);
        $em->flush();

        return $this->json([
            'code' => 200,
            'message' => 'Votre like a été ajouté!',
            'likes' => $commentesLikesRepository->count([
                'commente' => $commente
            ])
        ], 200);
    }
}
