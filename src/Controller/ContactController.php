<?php
namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();

        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        // Vérifier si l'utilisateur est à la fois un utilisateur enregistré et a un profil associé
        if ($user && $user->getProfile()) {
            $contact->setIdProfile($user->getProfile());
        }

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setCreatedAt(new \DateTimeImmutable());

            $entityManager->persist($contact);
            $entityManager->flush();

            $this->addFlash('success', 'Votre message a été envoyé avec succès.');

            // Rediriger vers la page profile si un utilisateur est connecté et s'il a un profil associé
            if ($user && $user->getProfile()) {
                return $this->redirectToRoute('app_profile');
            } else {
                return $this->redirectToRoute('app_home');
            }
        }

        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }
}
