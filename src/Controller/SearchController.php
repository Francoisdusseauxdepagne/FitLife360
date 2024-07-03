<?php
namespace App\Controller;

use App\Repository\SessionCoachingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search_coaches', methods: ['GET'])]
    public function search(Request $request, SessionCoachingRepository $SessionCoachingRepository): Response
    {
        $location = $request->query->get('location');
        $sessions = [];

        if ($location) {
            $sessions = $SessionCoachingRepository->findByLocation($location);
        }

        return $this->render('search/search.html.twig', [
            'sessions' => $sessions,
        ]);
    }
}
