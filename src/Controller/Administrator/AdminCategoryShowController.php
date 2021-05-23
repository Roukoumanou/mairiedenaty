<?php

namespace App\Controller\Administrator;

use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AdminCategoryShowController extends AbstractController
{
    /**
     * @Route("/admin/category/{name}", name="admin_category", methods={"GET"})
     *
     * @param CategoriesRepository $categoriesRepository
     * @return Response
     */
    public function show(Categories $category): Response
    {
        return $this->render('admin/categories/show.html.twig', [
            'category' => $category,
        ]);
    }
}
