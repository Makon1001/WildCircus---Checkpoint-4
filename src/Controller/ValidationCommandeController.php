<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Spectacle;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TotalPrice;

class ValidationCommandeController extends AbstractController
{
    /**
     * @Route("/validation/commande/{id}", name="validation_commande")
     */
    public function index(Reservation $reservation, TotalPrice $price)
    {
        $spectacles = $reservation->getSpectacle();

        $totalPrice = $price->TotalPrice($spectacles, $reservation->getNbEnfant(), $reservation->getNbAdulte());



        return $this->render('validation_commande/index.html.twig', [
            'reservation' => $reservation,
            'totalPrice'=> $totalPrice,
        ]);
    }

    /**
     * @Route("/{id}", name="reservation_delete_FromUser", methods={"DELETE"})
     */
    public function delete(Request $request, Reservation $reservation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home');
    }

}
