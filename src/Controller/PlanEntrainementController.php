<?php

namespace App\Controller;

use App\Entity\PlanEntrainement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlanEntrainementController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/plan/entrainement', name: 'app_plan_entrainement')]
    public function index(): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        // Récupérer les plans d'entraînement pour l'utilisateur actuel
        $planEntrainements = $this->entityManager->getRepository(PlanEntrainement::class)->findBy(['idProfile' => $user->getProfile()->getId()]);

        return $this->render('plan_entrainement/index.html.twig', [
            'planEntrainements' => $planEntrainements,
        ]);
    }
}
