<?php
namespace App\Controller;

use App\Entity\Messenger;
use App\Form\MessengerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessengerController extends AbstractController
{
    // Route pour lire les messages côté coach
    #[Route('/messenger/coach', name: 'app_messengerProfileCoach')]
    public function profileCoachRead(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $messagesCoach = $entityManager->getRepository(Messenger::class)->findBy(['idProfileCoach' => $user->getProfileCoach()]);

        return $this->render('messenger/readCoach.html.twig', [
            'messagesCoach' => $messagesCoach,
        ]);
    }

    // Route pour lire les messages côté profil
    #[Route('/messenger/profile', name: 'app_messengerProfile')]
    public function profileRead(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $messagesProfile = $entityManager->getRepository(Messenger::class)->findBy(['idProfile' => $user->getProfile()]);

        return $this->render('messenger/readProfile.html.twig', [
            'messagesProfile' => $messagesProfile,
        ]);
    }

    // Route pour envoyer un message côté coach
    #[Route('/messenger/coach/send', name: 'messenger_profileCoach_send')]
    public function profileCoachMessage(Request $request, EntityManagerInterface $entityManager): Response
    {
        $message = new Messenger();
        $form = $this->createForm(MessengerType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $profileCoach = $user->getProfileCoach();
            $message->setIdProfileCoach($profileCoach);
            $message->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($message);
            $entityManager->flush();

            $this->addFlash('success', 'Message envoyé avec succès');

            return $this->redirectToRoute('app_coach');
        }

        return $this->render('messenger/sendCoach.html.twig', [
            'messageForm' => $form->createView(),
        ]);
    }
    
    // Route pour envoyer un message côté profil
    #[Route('/messenger/profile/send', name: 'messenger_profile_send')]
    public function profileMessage(Request $request, EntityManagerInterface $entityManager): Response
    {
        $message = new Messenger();
        $form = $this->createForm(MessengerType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $profile = $user->getProfile();
            $message->setIdProfile($profile);
            $message->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($message);
            $entityManager->flush();

            $this->addFlash('success', 'Message envoyé avec succès');

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('messenger/sendProfile.html.twig', [
            'messageForm' => $form->createView(),
        ]);
    }
}
