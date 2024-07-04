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
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifier le type d'abonnement
        if ($this->checkSubscription() !== 'Vip' && $this->checkSubscription() !== 'Premium') {
            $this->addFlash('warning', 'Vous devez être abonné VIP pour accéder aux réservations.');
            return $this->redirectToRoute('app_home'); // Remplacez 'homepage' par la route de votre choix
        }

        $reservations = $entityManager->getRepository(Reservation::class)->findAll();

        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    #[Route('/reservation/new', name: 'app_reservation_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifier le type d'abonnement
        if ($this->checkSubscription() !== 'Vip' && $this->checkSubscription() !== 'Premium') {
            $this->addFlash('warning', 'Vous devez être abonné VIP pour créer une réservation.');
            return $this->redirectToRoute('app_reservation');
        }

        $profile = $this->getUser()->getProfile();
        $reservation = new Reservation();
        $reservation->setIdProfile($profile);

        // Pré-remplir la date et l'heure si elles sont passées en paramètre
        $date = $request->query->get('date');
        if ($date) {
            $reservation->setDate(new \DateTime($date));
            $reservation->setStartTime(new \DateTime($date . ' 08:00:00')); // Par défaut à 8h
        }

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->isReservationConflict($entityManager, $reservation)) {
                return $this->redirectToRoute('app_reservation_new');
            }

            $entityManager->persist($reservation);
            $entityManager->flush();

            $this->addFlash('success', 'La réservation a été ajoutée avec succès.');

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('reservation/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/reservation/delete/{id}', name: 'app_reservation_delete')]
    public function delete(Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifier le type d'abonnement
        if ($this->checkSubscription() !== 'Vip') {
            $this->addFlash('warning', 'Vous devez être abonné VIP pour supprimer une réservation.');
            return $this->redirectToRoute('app_reservation');
        }

        $entityManager->remove($reservation);
        $entityManager->flush();

        $this->addFlash('success', 'La réservation a été supprimée avec succès.');

        return $this->redirectToRoute('app_profile');
    }

    #[Route('/reservation/update/{id}', name: 'app_reservation_update')]
    public function update(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        
        // // Vérifier le type d'abonnement
        // if ($this->checkSubscription() !== 'vip') {
        //     $this->addFlash('warning', 'Vous devez être abonné VIP pour mettre à jour une réservation.');
        //     return $this->redirectToRoute('app_reservation');
        // }

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->isReservationConflict($entityManager, $reservation, true)) {
                return $this->redirectToRoute('app_reservation_update', ['id' => $reservation->getId()]);
            }

            $entityManager->flush();

            $this->addFlash('success', 'La réservation a été mise à jour avec succès.');

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('reservation/update.html.twig', [
            'form' => $form->createView(),
            'reservation' => $reservation,
        ]);
    }

    private function checkSubscription(): string
    {
        $profile = $this->getUser()->getProfile();
        return $profile->getIdAbonnement()->getTitle();
    }

    private function isReservationConflict(EntityManagerInterface $entityManager, Reservation $reservation, bool $isUpdate = false): bool
    {
        $date = $reservation->getDate();
        $startTime = $reservation->getStartTime();
        $profile = $reservation->getIdProfile();

        // Vérifier si l'heure de début est valide (8h, 9h, 10h, 11h)
        $startTimeHour = $startTime->format('H');
        $startTimeMinute = $startTime->format('i');
        if (!in_array($startTimeHour, ['08', '09', '10', '11']) || $startTimeMinute !== '00') {
            $this->addFlash('danger', 'Les réservations ne sont autorisées qu\'à 8h, 9h, 10h ou 11h.');
            return true;
        }

        // Vérifier si une réservation existe déjà pour cette date et cette heure
        $existingReservation = $entityManager->getRepository(Reservation::class)->findOneBy([
            'date' => $date,
            'startTime' => $startTime,
        ]);

        if ($existingReservation && (!$isUpdate || $existingReservation->getId() !== $reservation->getId())) {
            $this->addFlash('danger', 'Il y a déjà une réservation pour cette heure.');
            return true;
        }

        // Vérifier si le profil a déjà une réservation pour ce jour
        $existingReservationByProfile = $entityManager->getRepository(Reservation::class)->findOneBy([
            'date' => $date,
            'idProfile' => $profile,
        ]);

        if ($existingReservationByProfile && (!$isUpdate || $existingReservationByProfile->getId() !== $reservation->getId())) {
            $this->addFlash('danger', 'Vous avez déjà une réservation pour ce jour.');
            return true;
        }

        return false;
    }
}
