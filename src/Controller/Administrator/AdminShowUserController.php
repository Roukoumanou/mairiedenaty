<?php

namespace App\Controller\Administrator;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AdminShowUserController extends AbstractController
{
    /**
     * @Route("/admin/show/user/{id}", name="admin_show_user", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('admin/users/show.html.twig', [
            'user' => $user,
        ]);
    }
}
