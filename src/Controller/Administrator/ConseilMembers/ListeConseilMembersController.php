<?php

namespace App\Controller\Administrator\ConseilMembers;

use App\Entity\CommunalConseilMembers;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommunalConseilMembersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ListeConseilMembersController extends AbstractController
{
    /**
     * @Route("/admin/liste-des-membres-du-conseil-communal", name="conseils_members", methods={"GET"})
     *
     * @param CommunalConseilMembersRepository $repo
     * @return Response
     */
    public function list(CommunalConseilMembersRepository $repo): Response
    {
        return $this->render('admin/conseil_members/list.html.twig', [
            'members' => $repo->findAll()
        ]);
    }
}
