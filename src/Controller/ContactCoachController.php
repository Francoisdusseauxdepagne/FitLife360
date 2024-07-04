<?php
// src/Controller/ContactController.php

namespace App\Controller;

use App\Entity\ContactCoach;
use App\Entity\ProfileCoach;
use App\Form\ContactCoachType;
use App\Repository\ProfileCoachRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactCoachController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/contact-coach/{id}', name: 'contact_coach_form')]
    public function contactCoachForm(Request $request, int $id, ProfileCoachRepository $profileCoachRepository, EntityManagerInterface $entityManager): Response
    {
        // Récupérer le coach par son ID
        $coach = $profileCoachRepository->find($id);

        $contactCoach = new ContactCoach();

        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        if ($user && $user->getProfile()) {
            $contactCoach->setIdProfile($user->getProfile());
            $contactCoach->setEmail($user->getEmail());
            $contactCoach->setFirstname($user->getProfile()->getFirstname());
            $contactCoach->setName($user->getProfile()->getName());
        }

        $contactCoach->setIdProfileCoach($coach); // Associer le coach au formulaire

        $form = $this->createForm(ContactCoachType::class, $contactCoach);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactCoach->setCreatedAt(new \DateTimeImmutable());
            $entityManager = $this->entityManager;
            $entityManager->persist($contactCoach);
            $entityManager->flush();

            // Rediriger vers une page de confirmation ou une autre action
            $this->addFlash('success', 'Votre message a été envoyé avec succès. Le coach vous contactera dans les plus brefs délais.');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('contact/coach.html.twig', [
            'contactCoachForm' => $form->createView(),
            'coach' => $coach
        ]);
    }
}
