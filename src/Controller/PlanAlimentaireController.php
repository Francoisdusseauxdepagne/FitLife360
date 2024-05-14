<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PlanAlimentaireController extends AbstractController
{
    #[Route('/plan/alimentaire', name: 'app_plan_alimentaire')]
    public function index(): Response
    {
        return $this->render('plan_alimentaire/index.html.twig', [
            'controller_name' => 'PlanAlimentaireController',
        ]);
    }
}