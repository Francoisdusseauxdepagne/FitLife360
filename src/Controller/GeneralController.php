<?php

namespace App\Controller;

// use App\Entity\Avis;
// use App\Entity\Event;
// use App\Entity\Profile;
// use App\Entity\TutoVideo;
// use App\Entity\ProfileCoach;
// use Doctrine\ORM\EntityManagerInterface;
// use App\Repository\SessionCoachingRepository;
// use Symfony\Component\HttpFoundation\Request;
use App\Repository\AvisRepository;
use App\Repository\EventRepository;
use App\Repository\ProfileCoachRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GeneralController extends AbstractController
{
    // private EntityManagerInterface $entityManager;
    // public function __construct(EntityManagerInterface $entityManager)
    // {
    //     $this->entityManager = $entityManager;
    // }

    #[Route('/', name: 'app_home')]
    public function accueil(EventRepository $eventRepository, AvisRepository $avisRepository): Response
    {
        $events = $eventRepository->findAll();
        $avis = $avisRepository->findAll();

        $totalNotes = 0;
        $count = count($avis);

        foreach ($avis as $avi) {
            $totalNotes += $avi->getNote();
        }

        $averageRating = $count > 0 ? $totalNotes / $count : 0;
        
        return $this->render('home/index.html.twig', [
            'events' => $events,
            'avis' => $avis,
            'averageRating' => $averageRating
        ]);
    }

    #[Route('/apropos', name: 'app_apropos')]
    public function apropos(ProfileCoachRepository $profileCoachRepository): Response
    {
        $ProfileCoaches = $profileCoachRepository->findAll();

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

    #[Route('/404', name: 'app_error404')]
    public function error404(): Response
    {
        return $this->render('404/error.html.twig');
    }

    //
}