<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ActualiteRepository;
use App\Repository\SpectacleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(
        ActualiteRepository $actualiteRepository,
        SpectacleRepository $spectacleRepository,
        Request $request)
    {

        $spectacles = $spectacleRepository->findAllActualandSortByDate();
        $actus = $actualiteRepository->findAll();


        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('validation_commande', ['id'=>$reservation->getId()]);
        }

        return $this->render('home/index.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
            'spectacles'=> $spectacles,
            'actus'=>$actus,
        ]);
    }
}
