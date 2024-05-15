<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Repository\AbonnementRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/panier/{id}', name: 'app_panier')]
    public function index(int $id, AbonnementRepository $abonnementRepository): Response
    {
        // Récupérer l'abonnement à ajouter au panier
        $abonnement = $abonnementRepository->find($id);

        if (!$abonnement) {
            throw $this->createNotFoundException('Abonnement non trouvé');
        }

        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        // Créer une nouvelle instance de Panier et lui attribuer l'abonnement et le profil de l'utilisateur
        $panier = new Panier();
        $panier->setCreatedAt(new DateTimeImmutable());
        $panier->setIdAbonnement($abonnement);
        $panier->setIdProfile($user->getProfile());

        // Sauvegarder le panier en base de données
        $this->entityManager->persist($panier);
        $this->entityManager->flush();

        // Rediriger l'utilisateur vers la page du panier
        return $this->redirectToRoute('panier');
    }

    #[Route('/panier', name: 'panier')]
    public function showPanier(): Response
    {
        // Récupérer le panier de l'utilisateur connecté
        $panier = $this->entityManager->getRepository(Panier::class)->findOneBy(['idProfile' => $this->getUser()->getProfile()]);

        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
        ]);
    }
}
