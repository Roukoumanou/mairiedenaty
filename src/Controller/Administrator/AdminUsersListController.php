<?php

namespace App\Controller\Administrator;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AdminUsersListController extends AbstractController
{
    /**
     * @Route("/admin/users/list", name="admin_users", methods={"GET"})
     *
     * @param UserRepository $userRepository
     * @return Response
     */
    public function users(UserRepository $userRepository): Response
    {
        return $this->render('admin/users/list.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
}
