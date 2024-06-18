<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\TutoVideo;
use App\Entity\ProfileCoach;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GeneralController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_home')]
    public function accueil(): Response
    {
        $events = $this->entityManager->getRepository(Event::class)->findAll();
        
        return $this->render('home/index.html.twig', [
            'events' => $events,
        ]);
    }

    #[Route('/apropos', name: 'app_apropos')]
    public function apropos(): Response
    {
        $ProfileCoaches = $this->entityManager->getRepository(ProfileCoach::class)->findAll();

        return $this->render('apropos/index.html.twig', [
            'profileCoachs' => $ProfileCoaches,
        ]);
    }

    #[Route('/terms', name: 'app_terms')]
    public function terms(): Response
    {
        return $this->render('terms/terms.html.twig', [
            'controller_name' => 'TermsController',
        ]);
    }

    #[Route('/mentions', name: 'app_mentions')]
    public function mentions(): Response
    {
        return $this->render('terms/mentions.html.twig', [
            'controller_name' => 'TermsController',
        ]);
    }

    #[Route('/cgv', name: 'app_cgv')]
    public function cgv(): Response
    {
        return $this->render('terms/cgv.html.twig', [
            'controller_name' => 'TermsController',
        ]);
    }

    #[Route('/tuto/video', name: 'app_tuto_video')]
    public function video(): Response
    {
        $videos = $this->entityManager->getRepository(TutoVideo::class)->findAll();

        return $this->render('tuto_video/index.html.twig', [
            'videos' => $videos,
        ]);
    }
}