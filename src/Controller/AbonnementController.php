<?php

namespace App\Controller;

use App\Entity\Abonnement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AbonnementController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/abonnement', name: 'app_abonnement')]
    public function index(): Response
    {
        $abonnements = $this->entityManager->getRepository(Abonnement::class)->findAll();

        return $this->render('abonnement/index.html.twig', [
            'abonnements' => $abonnements,
        ]);
    }
}