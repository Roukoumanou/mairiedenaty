<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class MotDuMaireController extends AbstractController
{
    /**
     * @Route("/mot-du-maire", name="mot_du_maire", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('mot_du_maire/index.html.twig', []);
    }
}
