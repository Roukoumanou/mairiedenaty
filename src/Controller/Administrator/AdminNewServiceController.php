<?php

namespace App\Controller\Administrator;

use App\Entity\Services;
use App\Form\ServicesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AdminNewServiceController extends AbstractController
{
    /**
     * @Route("/admin/new/service", name="admin_new_service", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $service = new Services();

        $form = $this->createForm(ServicesType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($service);
            $em->flush();

            $this->addFlash(
                'success',
                'Service Ajouté!'
            );

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('admin/services/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
