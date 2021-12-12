<?php

namespace App\Controller\Administrator;

use App\Entity\Prestations;
use App\Form\PrestationsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AdminPrestationNewController extends AbstractController
{
    /**
     * @Route("/admin/prestation/new", name="admin_prestation_new", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $presta = new Prestations();

        $form = $this->createForm(PrestationsType::class, $presta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($presta);
            $em->flush();

            $this->addFlash(
                'success',
                'Prèstation Ajoutée!'
            );

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('admin/prestations/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
