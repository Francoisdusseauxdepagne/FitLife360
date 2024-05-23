<?php

namespace App\Controller;

use App\Entity\Reporting;
use App\Form\ReportingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReportingController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/reporting', name: 'app_reporting')]
    public function index(Request $request): Response
    {
        $user = $this->getUser();
        
        $reporting = new Reporting();
        
        $form = $this->createForm(ReportingType::class, $reporting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $reporting->getComment();
            $reporting->setCreatedAt(new \DateTimeImmutable());
            $reporting->setIdProfile($user->getProfile());
            $reporting->setComment($comment);
            
            $this->entityManager->persist($reporting);
            $this->entityManager->flush();

            $this->addFlash('success', 'Le signalement a été envoyé avec succès.');

            return $this->redirectToRoute('app_tuto_video');
        }

        return $this->render('reporting/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
