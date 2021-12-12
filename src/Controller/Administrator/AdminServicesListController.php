<?php

namespace App\Controller\Administrator;

use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AdminServicesListController extends AbstractController
{
    /**
     * @Route("/admin/services/list", name="admin_services_list", methods={"GET"})
     *
     * @param ServicesRepository $servicesRepository
     * @return Response
     */
    public function services(ServicesRepository $servicesRepository): Response
    {
        return $this->render('admin/services/index.html.twig', [
            'services' => $servicesRepository->findAll(),
        ]);
    }
}
