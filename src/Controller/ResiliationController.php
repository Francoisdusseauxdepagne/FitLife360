<?php

namespace App\Controller;

use App\Entity\Resiliation;
use App\Form\ResiliationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ResiliationController extends AbstractController
{
    #[Route('/resiliation', name: 'app_resiliation')]
    public function resiliation(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Vérifier si l'utilisateur est connecté
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            // Rediriger vers la page d'inscription s'il n'est pas connecté
            return $this->redirectToRoute('app_login');
        }

        $resiliation = new Resiliation();

        $user = $this->getUser();
        if ($user) {
            $profile = $user->getProfile(); // Assurez-vous que la méthode getProfile() existe dans votre entité User
            $resiliation->setIdProfile($profile);
        }

        $form = $this->createForm(ResiliationType::class, $resiliation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $content = $form->get('content')->getData();
            $resiliation->setCreatedAt(new \DateTimeImmutable());
            $resiliation->setContent($content);
            $entityManager->persist($resiliation);
            $entityManager->flush();

            $this->addFlash('success', 'Votre message a été envoyé avec succès.');

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('resiliation/index.html.twig', [
            'resiliationForm' => $form->createView(),
        ]);
    }
}
