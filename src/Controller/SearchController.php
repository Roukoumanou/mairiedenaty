<?php

namespace App\Controller;

use App\Repository\PrestationsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search", methods={"GET"})
     */
    public function index(PrestationsRepository $prestationsRepository)
    {
        if (isset($_GET['search'])) {
            $search = (string) trim($_GET['search']);
            $prestations = $prestationsRepository->findByName($search);
            $result = [];
            foreach ($prestations as $prestation) {
                $url = $this->generateUrl('presta_show', ['id' => $prestation['id']], UrlGeneratorInterface::ABSOLUTE_URL);
                $result[] =
                    "<a class='text-warning'
                        href='$url'>
                    $prestation[name]
                    </a> <hr/>";
            }
            return new JsonResponse($result);
        }
        return new JsonResponse("");
    }
}
