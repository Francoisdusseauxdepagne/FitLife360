<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReportingController extends AbstractController
{
    #[Route('/reporting', name: 'app_reporting')]
    public function index(): Response
    {
        return $this->render('reporting/index.html.twig', [
            'controller_name' => 'ReportingController',
        ]);
    }
}
