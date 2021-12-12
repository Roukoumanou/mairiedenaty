<?php

namespace App\Controller\Administrator;

use App\Entity\Prestations;
use App\Form\PrestationsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AdminPrestationEditController extends AbstractController
{
    /**
     * @Route("/admin/prestation/update/{id}", name="admin_prestation_update", methods={"GET", "POST"})
     *
     * @param Prestations $presta
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function update(
        Prestations $presta,
        Request $request,
        EntityManagerInterface $em
    ): Response{
        $form = $this->createForm(PrestationsType::class, $presta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $presta->setUpdatedAt(new \DateTime());

            $em->flush();

            $this->addFlash(
                'success',
                'Prèstation modifiée!'
            );

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('admin/prestations/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
