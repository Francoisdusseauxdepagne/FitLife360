<?php

namespace App\Controller;

use App\Entity\Coach;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AproposController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/apropos', name: 'app_apropos')]
    public function index(): Response
    {
        $coaches = $this->entityManager->getRepository(Coach::class)->findAll();

        return $this->render('apropos/index.html.twig', [
            'coaches' => $coaches,
        ]);
    }
}



