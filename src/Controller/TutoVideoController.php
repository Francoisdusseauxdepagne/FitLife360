<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TutoVideoController extends AbstractController
{
    #[Route('/tuto/video', name: 'app_tuto_video')]
    public function index(): Response
    {
        return $this->render('tuto_video/index.html.twig', [
            'controller_name' => 'TutoVideoController',
        ]);
    }
}
