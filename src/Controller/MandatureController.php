<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommunalConseilMembersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MandatureController extends AbstractController
{
    /**
     * @Route("/mandature-actuelle-du-conseil-communal", name="mandature", methods={"GET"})
     *
     * @param CommunalConseilMembersRepository $repo
     * @return Response
     */
    public function mandature(CommunalConseilMembersRepository $repo): Response
    {
        $maire = $repo->getMaire();
        $adjoints = $repo->getAdjoints();
        $c_as = $repo->getCAs();
        $caef = $repo->getCaef();
        $casc = $repo->getCasc();
        $plaintes = $repo->getPlaintes();
        $cade = $repo->getCade();
        $c_cs = $repo->getCcs();

        return $this->render('articles/conseils/mandature.html.twig', [
            'members' => compact('maire', 'adjoints', 'c_as', 'caef', 'casc', 'plaintes', 'cade', 'c_cs')
        ]);
    }
}
