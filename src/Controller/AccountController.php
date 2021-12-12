<?php

namespace App\Controller;

use App\Entity\PasswordEdit;
use App\Form\AccountUpdateFormType;
use Symfony\Component\Form\FormError;
use App\Form\AccountPasswordUpdateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/account")
 */
final class AccountController extends AbstractController
{
    /**
     * @Route("/edit", name="account_update", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function edit(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(AccountUpdateFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUpdatedAt(new \DateTime());

            $em->flush();

            $this->addFlash(
                'success',
                'Votre compte a bien été modifié!'
            );

            return $this->redirectToRoute('home');
        }

        return $this->render('account/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/password-edit", name="password_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     *
     * @param Request $request
     * @param UserPasswordHasherInterface $encoder
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function passwordEdit(
        Request $request,
        UserPasswordHasherInterface $encoder,
        EntityManagerInterface $em
    ): Response{
        $updatePassword = new PasswordEdit();

        $user = $this->getUser();

        $form = $this->createForm(AccountPasswordUpdateType::class, $updatePassword);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (!$encoder->isPasswordValid($user, $updatePassword->getOldPassword())) {
                // Je renvois un méssage d'erreur si l'encien mot de passe est pourri
                $form->get("oldPassword")->addError(new FormError("Vous n'avez pas saisi le bon mot de passe !"));
            } else {

                $hash = $encoder->hashPassword($user, $updatePassword->getNewPassword());
                $user->setPassword($hash)
                    ->setUpdatedAt(new \DateTime());

                $em->flush();

                $this->addFlash(
                    'success',
                    'Vous avez modifié.e votre mot de passe avec succès!'
                );

                return $this->redirectToRoute('home');
            }
        }

        return $this->render('account/password_edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
