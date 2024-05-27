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

        return $this->render('profile/index.html.twig', [
            'profile' => $profile,
            'reservation' => $reservation
        ]);
    }

    #[Route('/profile/updateAbonnement', name: 'profile_update')]
    public function updateProfileAbonnement(Request $request, AbonnementRepository $abonnementRepository): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();
        // Récupérer l'abonnement sélectionné
        $abonnementId = $request->request->get('abonnement_id');
        $abonnement = $abonnementRepository->find($abonnementId);

        // Mettre à jour le profil de l'utilisateur avec l'abonnement sélectionné
        $user->getProfile()->setIdAbonnement($abonnement);

        // Sauvegarder les changements en base de données
        $this->entityManager->persist($user->getProfile());
        $this->entityManager->flush();

        // Rediriger l'utilisateur vers la page du profil
        return $this->redirectToRoute('app_show_profile');
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