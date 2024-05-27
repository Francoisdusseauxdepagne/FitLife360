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

            $this->addFlash('success', 'La reservation a été correctement ajoutée.');

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('reservation/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/reservation/delete/{id}', name: 'app_reservation_delete')]
    public function delete(Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($reservation);
        $entityManager->flush();

        $this->addFlash('success', 'La réservation a été supprimée avec succès.');

        return $this->redirectToRoute('app_profile');
    }

    #[Route('/reservation/update/{id}', name: 'app_reservation_update')]
    public function update(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Si le formulaire est soumis et valide, enregistrez les modifications
            $entityManager->flush();

            $this->addFlash('success', 'La réservation a été mise à jour avec succès.');

            return $this->redirectToRoute('app_profile');
        }

        // Si le formulaire n'est pas encore soumis ou s'il y a des erreurs de validation, affichez le formulaire de modification
        return $this->render('reservation/update.html.twig', [
            'form' => $form->createView(),
            'reservation' => $reservation,
        ]);
    }
}
