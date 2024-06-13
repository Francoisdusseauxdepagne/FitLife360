<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Form\ProfileType;
use App\Repository\AbonnementRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{   
    private function calculateAge(\DateTimeImmutable $dateDeNaissance): int
    {
        $today = new \DateTimeImmutable();
        $age = $today->diff($dateDeNaissance)->y;

        return $age;
    }

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/profile', name: 'app_profile')]
    public function index(Request $request): Response
    {
        $user = $this->getUser();
        $profile = $user->getProfile();
        
        if ($user->isVerified() == false) {
            $this->addFlash('warning', 'Merci de confirmer votre adresse e-mail pour réaliser votre première connexion.');
            return $this->redirectToRoute('app_home');
        }
        
        if ($profile === null) {
            return $this->redirectToRoute('app_edit_profile');
        }

        return $this->redirectToRoute('app_show_profile');
    }

    #[Route('/profile/edit', name: 'app_edit_profile')]
    public function editProfile(Request $request): Response
    {
        $user = $this->getUser();
        $profile = $user->getProfile() ?? new Profile();
        
        $form = $this->createForm(ProfileType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Calculer l'âge
            $dateDeNaissance = $form->get('dateDeNaissance')->getData();
            $age = $this->calculateAge($dateDeNaissance);

            // Vérification age
            if ($age < 18 ) {
                $this->addFlash('warning', 'Vous devez avoir au moins 18 ans.');
                return $this->redirectToRoute('app_edit_profile');
            } elseif ($age > 99) {
                $this->addFlash('warning', 'Vous ne pouvez pas avoir plus de 99 ans pour créer un profil.');
                return $this->redirectToRoute('app_edit_profile');
            }

            $profile->setIdUser($user);
            $profile->setCreatedAt(new \DateTimeImmutable());
            $profile->setIsActive(true);
            
            $this->entityManager->persist($profile);
            $this->entityManager->flush();
            
            $this->addFlash('success', 'Profil créé avec succès !');
            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/profile/show', name: 'app_show_profile')]
    public function showProfile(ReservationRepository $reservationRepository): Response
    {
        $user = $this->getUser();
        $profile = $user->getProfile();

        $reservation = $reservationRepository->findOneBy ([
            'idProfile' => $profile
        ]);

        $subscriptionDate = $profile->getSubscriptionDate();

        return $this->render('profile/index.html.twig', [
            'profile' => $profile,
            'reservation' => $reservation,
            'subscriptionDate' => $subscriptionDate
        ]);
    }

    #[Route('/profile/updateProfile', name: 'app_update_profile')]
    public function updateProfileInfo(Request $request): Response
    {
        $user = $this->getUser();
        $profile = $user->getProfile();

        // Créer le formulaire de mise à jour du profil
        $form = $this->createForm(ProfileType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profile->setUpdatedAt(new \DateTimeImmutable()); // Mettre à jour la date de mise à jour du profil

            $this->entityManager->flush();

            $this->addFlash('success', 'Profil mis à jour avec succès !');
            return $this->redirectToRoute('app_show_profile');
        }

        return $this->render('profile/update.html.twig', [
            'form' => $form->createView()
        ]);
    }
}