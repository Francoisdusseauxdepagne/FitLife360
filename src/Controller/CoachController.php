<?php

namespace App\Controller;

// src/Controller/CoachController.php

use App\Entity\ProfileCoach;
use App\Entity\PlanAlimentaire;
use App\Entity\PlanEntrainement;
use App\Form\PlanAlimentaireType;
use App\Form\PlanEntrainementType;
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

        return $this->render('coach/editCoach.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/coach/create-entrainement', name: 'app_coach_create_entrainement')]
    public function createEntrainement(Request $request): Response
    {
        $user = $this->getUser();
        $profileCoach = $user->getProfileCoach();

        $planEntrainement = new PlanEntrainement();
        $form = $this->createForm(PlanEntrainementType::class, $planEntrainement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planEntrainement->setIdProfileCoach($profileCoach);
            $planEntrainement->setCreatedAt(new \DateTimeImmutable());
            $planEntrainement->setUpdatedAt(new \DateTimeImmutable());

            $this->entityManager->persist($planEntrainement);
            $this->entityManager->flush();

            $this->addFlash('success', 'Plan d\'entraînement créé avec succès !');
            return $this->redirectToRoute('app_coach');
        }

        return $this->render('coach/createEntrainement.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/coach/create-alimentaire', name: 'app_coach_create_alimentaire')]
    public function createAlimentaire(Request $request): Response
    {
        $planAlimentaire = new PlanAlimentaire();
        $form = $this->createForm(PlanAlimentaireType::class, $planAlimentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profileCoach = $this->getUser()->getProfileCoach();
            $planAlimentaire->setIdProfileCoach($profileCoach);

            $this->entityManager->persist($planAlimentaire);
            $this->entityManager->flush();

            $this->addFlash('success', 'Plan d\'alimentataire créé avec succès !');

            return $this->redirectToRoute('app_coach');
        }

        return $this->render('coach/createNutrition.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
