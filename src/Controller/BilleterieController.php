<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\SpectacleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BilleterieController extends AbstractController
{
    /**
     * @Route("/billeterie", name="billeterie")
     */
    public function index(SpectacleRepository $spectacleRepository, Request $request)
    {
        $spectacles = $spectacleRepository->findAllActualandSortByDate();

        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('validation_commande', ['id'=>$reservation->getId()]);
        }

        return $this->render('billeterie/index.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
            'spectacles'=> $spectacles
        ]);
    }

}
