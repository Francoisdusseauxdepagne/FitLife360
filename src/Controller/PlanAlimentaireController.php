<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlanAlimentaireController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/plan/alimentaire', name: 'app_plan_alimentaire')]
    public function index(): Response
    {
        $user = $this->getUser();

        $planAlimentaires = $this->entityManager->getRepository('App\Entity\PlanAlimentaire')->findBy(['idProfile' => $user->getProfile()->getId()]);

        return $this->render('plan_alimentaire/index.html.twig', [
            'planAlimentaires' => $planAlimentaires,
        ]);
    }
}