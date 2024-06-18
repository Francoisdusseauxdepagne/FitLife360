<?php
// src/Controller/ContactEventController.php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\ContactEvent;
use App\Form\ContactEventType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactEventController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/contact/event/{id}', name: 'app_contact_event')]
    public function contactEvent(Request $request, Event $event): Response
    {
        $user = $this->getUser();

        $contactEvent = new ContactEvent();

        $contactEvent->setIdProfile($user->getProfile());
        $contactEvent->setIdEvent($event);

        $form = $this->createForm(ContactEventType::class, $contactEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactEvent->setCreatedAt(new \DateTimeImmutable());

            $this->entityManager->persist($contactEvent);
            $this->entityManager->flush();

            $this->addFlash('success', 'Votre message a été envoyé avec succès.');

            // Redirection vers une autre page après l'envoi du formulaire
            return $this->redirectToRoute('app_profile'); // Remplacez 'app_profile' par le nom de votre route de redirection
        }

        // Si le formulaire n'est pas soumis ou n'est pas valide, rendre la vue du formulaire
        return $this->render('contact_event/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}