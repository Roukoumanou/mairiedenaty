<?php

namespace App\Controller\Administrator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AdminHomeController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home", methods={"GET"})
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', []);
    }
}
