<?php

namespace App\Controller;

use App\Entity\Prestations;
use App\Repository\ArticlesRepository;
use App\Repository\PrestationsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DemarchesController extends AbstractController
{
    /**
     * @Route("/demarches", name="demarches", methods={"GET"})
     *
     * @param PrestationsRepository $prestationsRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function mesDemarches(
        PrestationsRepository $prestationsRepository,
        PaginatorInterface $paginator, Request $request
    ): Response{
        $prestations = $paginator->paginate(
            $prestationsRepository->findBy([
                'status' => true
            ]), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );

        return $this->render('articles/demarches/demarches.html.twig', [
            'prestations' => $prestations,
        ]);
    }

    /**
     * @Route("/demarche/{id}", name="presta_show", methods={"GET"})
     * 
     * @param Prestations $prestation
     * @return Response
     */
    public function show(Prestations $prestation): Response
    {
        return $this->render('articles/demarches/show.html.twig', [
            'prestation' => $prestation,
        ]);
    }
}
