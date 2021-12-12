<?php

namespace App\Controller\Administrator;

use App\Entity\User;
use App\Form\AdminRegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class AdminUserAddController extends AbstractController
{
    /**
     * @Route("/admin/user/add", name="admin_user_add", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserPasswordHasherInterface $encoder
     * @return Response
     */
    public function new(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $encoder
    ): Response{
        $user = new User();

        $form = $this->createForm(AdminRegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setRoles(["ROLE_REDACTOR"])
                ->setIsVerified(true)
                ->setPassword($encoder->hashPassword(
                    $user,
                    $form->get('password')->getData()
                ));

            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                'Utilisateur Ajouté!'
            );

            return $this->redirectToRoute('admin_home');
        }
        return $this->render('admin/users/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
