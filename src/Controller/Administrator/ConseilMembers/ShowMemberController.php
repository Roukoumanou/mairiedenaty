<?php

namespace App\Controller\Administrator\ConseilMembers;

use App\Entity\CommunalConseilMembers;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ShowMemberController extends AbstractController
{
    /**
     * @Route("/admin/membre-du-conseil-communal/{id}/{slug}", name="conseil_member", methods={"GET"})
     *
     * @param CommunalConseilMembers $member
     * @return Response
     */
    public function list(CommunalConseilMembers $member): Response
    {
        return $this->render('admin/conseil_members/show.html.twig', [
            'member' => $member
        ]);
    }
}
