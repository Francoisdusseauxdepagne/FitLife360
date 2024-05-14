<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PlanEntrainementController extends AbstractController
{
    #[Route('/plan/entrainement', name: 'app_plan_entrainement')]
    public function index(): Response
    {
        return $this->render('plan_entrainement/index.html.twig', [
            'controller_name' => 'PlanEntrainementController',
        ]);
    }
}