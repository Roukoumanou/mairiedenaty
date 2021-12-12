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
     *
     * @param PrestationsRepository $prestationsRepository
     * @return void
     */
    public function search(PrestationsRepository $prestationsRepository)
    {
        if (isset($_GET['search'])) {
            $search = (string) trim($_GET['search']);
            $prestations = $prestationsRepository->findByName($search);
            $result = [];
            foreach ($prestations as $prestation) {
                $url = $this->generateUrl('presta_show', ['id' => $prestation['id']], UrlGeneratorInterface::ABSOLUTE_URL);
                $result[] =
                    "<p classe='container'><a class='text-warning'
                        href='$url'>
                    $prestation[name]
                    </a></p>";
            }
            return new JsonResponse($result);
        }
        return new JsonResponse("");
    }
}
