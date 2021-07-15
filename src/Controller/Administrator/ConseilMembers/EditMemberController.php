<?php

namespace App\Controller\Administrator\ConseilMembers;

use App\Entity\CommunalConseilMembers;
use App\Form\CommunalConseilMembersType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class EditMemberController extends AbstractController
{
    /**
     * @Route("/admin/membre-du-conseil/{id}/{slug}", name="conseil_member_edit", methods={"GET", "POST"})
     *
     * @param CommunalConseilMembers $member
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function edit(CommunalConseilMembers $member, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CommunalConseilMembersType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash(
                'success',
                "Membre Modifié avec succès!"
            );

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('admin/conseil_members/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
