<?php

namespace App\Controller;

use App\Entity\TutoVideo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TutoVideoController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/tuto/video', name: 'app_tuto_video')]
    public function index(): Response
    {

        $videos = $this->entityManager->getRepository(TutoVideo::class)->findAll();

        return $this->render('tuto_video/index.html.twig', [
            'videos' => $videos,
        ]);
    }
}
