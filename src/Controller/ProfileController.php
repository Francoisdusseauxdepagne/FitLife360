<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{   
    private $entityManager;

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
}
