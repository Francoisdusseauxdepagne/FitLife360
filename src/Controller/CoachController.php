<?php

namespace App\Controller;

use App\Entity\ProfileCoach;
use App\Form\ProfileTypeCoachType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoachController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/coach', name: 'app_coach')]
    public function index(): Response
    {
        $user = $this->getUser();
        $profileCoach = $user->getProfileCoach();

        if ($user->isVerified() == false) {
            $this->addFlash('warning', 'Merci de confirmer votre adresse e-mail pour réaliser votre première connexion.');
            return $this->redirectToRoute('app_home');
        }

        if ($profileCoach === null) {
            return $this->redirectToRoute('app_edit_profileCoach');
        }

        return $this->render('coach/index.html.twig', [
            'controller_name' => 'CoachController',
            'profileCoach' => $profileCoach,
        ]);
    }


    #[Route('/coach/edit', name: 'app_edit_profileCoach')]
    public function editProfile(Request $request): Response
    {
        $user = $this->getUser();
        $profileCoach = $user->getProfileCoach() ?? new ProfileCoach();

        $form = $this->createForm(ProfileTypeCoachType::class, $profileCoach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profileCoach->setIdUser($user);
            $profileCoach->setCreatedAt(new \DateTimeImmutable());
            $profileCoach->setActive(true);

            $this->entityManager->persist($profileCoach);
            $this->entityManager->flush();

            $this->addFlash('success', 'Profil Coach créé avec succès !');
            return $this->redirectToRoute('app_coach');
        }

        return $this->render('coach/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
