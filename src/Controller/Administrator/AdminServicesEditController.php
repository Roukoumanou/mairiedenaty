<?php

namespace App\Controller\Administrator;

use App\Entity\Services;
use App\Form\ServicesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AdminServicesEditController extends AbstractController
{
    /**
     * @Route("/admin/service/{id}/edit", name="admin_service_edit", methods={"GET", "POST"})
     *
     * @param Services $service
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function edit(
        Services $service,
        Request $request,
        EntityManagerInterface $em
    ): Response{
        $form = $this->createForm(ServicesType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $service->setUpdatedAt(new \DateTime());

            $em->persist($service);
            $em->flush();

            $this->addFlash(
                'success',
                'Service Modifié!'
            );

            return $this->redirectToRoute('admin_home');
        }
        return $this->render('admin/services/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
