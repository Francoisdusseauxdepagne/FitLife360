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
        // Récupérer le commentaire à partir d'une source appropriée
        // Par exemple, à partir de la requête ou d'une autre entité
        
        // Créer une nouvelle instance de Reporting
        $reporting = new Reporting();
        
        // Créer un formulaire basé sur le ReportingType et passer l'instance de Reporting
        $form = $this->createForm(ReportingType::class, $reporting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer le commentaire à partir du formulaire
            $comment = $reporting->getComment();
            
            // Définir le commentaire pour le Reporting
            $reporting->setCreatedAt(new \DateTimeImmutable());
            
            // Persistez l'entité Reporting
            $this->entityManager->persist($reporting);
            $this->entityManager->flush();

            // Ajouter un message flash pour indiquer que le signalement a été envoyé avec succès
            $this->addFlash('success', 'Le signalement a été envoyé avec succès.');

            // Rediriger vers une autre page après avoir envoyé le signalement avec succès
            return $this->redirectToRoute('app_tuto_video');
        }

        // Rendre le formulaire dans le template
        return $this->render('reporting/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
