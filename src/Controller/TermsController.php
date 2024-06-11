<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TermsController extends AbstractController
{
    #[Route('/terms', name: 'app_terms')]
    public function index(): Response
    {
        return $this->render('terms/terms.html.twig', [
            'controller_name' => 'TermsController',
        ]);
    }

    #[Route('/mentions', name: 'app_mentions')]
    public function privacy(): Response
    {
        return $this->render('terms/mentions.html.twig', [
            'controller_name' => 'TermsController',
        ]);
    }
}
