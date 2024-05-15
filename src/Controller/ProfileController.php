<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Form\ProfileType;
use App\Repository\AbonnementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{   
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
    public function showProfile(): Response
    {
        $user = $this->getUser();
        $profile = $user->getProfile();

        return $this->render('profile/index.html.twig', [
            'profile' => $profile
        ]);
    }

    #[Route('/profile/update', name: 'profile_update')]
    public function updateProfile(Request $request, AbonnementRepository $abonnementRepository): Response
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

    #[Route('/profile/delete-abonnement', name: 'profile_delete_abonnement')]
    public function deleteAbonnement(Request $request): Response
    {
        $user = $this->getUser();
        $user->getProfile()->setIdAbonnement(null);
    
        $this->entityManager->persist($user->getProfile());
        $this->entityManager->flush();
    
        $this->addFlash('success', 'Abonnement supprimé avec succès !');
        return $this->redirectToRoute('app_show_profile');
    }
}
