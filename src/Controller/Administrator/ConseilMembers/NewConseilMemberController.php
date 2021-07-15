<?php

namespace App\Controller\Administrator\ConseilMembers;

use App\Entity\CommunalConseilMembers;
use App\Form\CommunalConseilMembersType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class NewConseilMemberController extends AbstractController
{
    /**
     * Nouveau membre
     * 
     * @Route("/admin/new-conseil-member", name="conseil_member_new", methods={"GET", "POSt"})
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function newConseilMember(Request $request, EntityManagerInterface $em): Response
    {
        $member = new CommunalConseilMembers();

        $form = $this->createForm(CommunalConseilMembersType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($member);
            $em->flush();

            $this->addFlash(
                'success',
                "Membre ajouté avec succès!"
            );

            return $this->redirectToRoute('admin_home');
        }
        return $this->render('admin/conseil_members/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
