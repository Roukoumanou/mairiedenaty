<?php

namespace App\Controller\Administrator;

use App\Entity\User;
use App\Form\AccountUpdateFormType;
use App\Form\AdminRegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AdminUserEditController extends AbstractController
{
    /**
     * @Route("/admin/user/edit/{id}", name="admin_user_edit", methods={"GET", "POST"})
     */
    public function edit(User $user, EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(AccountUpdateFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash(
                'success',
                'Utilisateur Modifié(e)!'
            );

            return $this->redirectToRoute('admin_home');
        }
        return $this->render('admin/users/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
