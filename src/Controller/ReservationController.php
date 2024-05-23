<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reservations = $entityManager->getRepository(Reservation::class)->findAll();

        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    #[Route('/reservation/new', name: 'app_reservation_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservation = new Reservation();

        // Pré-remplir la date et l'heure si elles sont passées en paramètre
        $date = $request->query->get('date');
        if ($date) {
            $reservation->setDate(new \DateTime($date));
            $reservation->setStartTime(new \DateTime($date . ' 09:00:00')); // Par défaut à 9h
        }

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Vérifier si une réservation existe déjà pour cette heure
            $date = $reservation->getDate();
            $reservation->setIdProfile($this->getUser()->getProfile());
            $startTime = $reservation->getStartTime();
            $existingReservation = $entityManager->getRepository(Reservation::class)->findOneBy(['date' => $date, 'startTime' => $startTime]);
            if ($existingReservation) {
                $this->addFlash('danger', 'Il y a déjà une réservation pour cette heure.');
                return $this->redirectToRoute('app_reservation_new');
            }

            // Vérifier si l'heure de début est valide (9h, 10h, 11h)
            $startTimeHour = $startTime->format('H');
            if (!in_array($startTimeHour, ['09', '10', '11'])) {
                $this->addFlash('danger', 'Les réservations ne sont autorisées qu\'à 9h, 10h ou 11h.');
                return $this->redirectToRoute('app_reservation_new');
            }

            // Si tout est valide, enregistrer la réservation
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation');
        }

        return $this->render('reservation/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
