<?php

namespace App\Controller\Administrator;

use App\Repository\PrestationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AdminPrestationsListController extends AbstractController
{
    /**
     * @Route("/admin/prestations/list", name="admin_prestations_list", methods={"GET"})
     *
     * @param PrestationsRepository $prestationsRepository
     * @return Response
     */
    public function index(PrestationsRepository $prestationsRepository): Response
    {
        return $this->render('admin/prestations/index.html.twig', [
            'prestations' => $prestationsRepository->findAll(),
        ]);
    }
}
