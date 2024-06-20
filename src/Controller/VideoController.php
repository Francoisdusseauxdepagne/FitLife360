<?php

namespace App\Controller;

use App\Entity\TutoVideo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/tuto/video', name: 'app_tuto_video')]
    public function video(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifier le type d'abonnement
        if (!$this->checkVideoSubscription()) {
            $this->addFlash('warning', 'Vous devez être abonné Premium ou VIP pour accéder aux vidéos sportives.');
            return $this->redirectToRoute('app_home');
        }

        $videos = $this->entityManager->getRepository(TutoVideo::class)->findAll();

        return $this->render('tuto_video/index.html.twig', [
            'videos' => $videos,
        ]);
    }

    private function checkVideoSubscription(): bool
    {
        $profile = $this->getUser()->getProfile();
        $subscriptionTitle = $profile->getIdAbonnement()->getTitle();

        return in_array($subscriptionTitle, ['Vip', 'Premium']);
    }
}
