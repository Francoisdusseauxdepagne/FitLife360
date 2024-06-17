<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\Abonnement;
use App\Repository\AbonnementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    #[Route('/abonnements', name: 'abonnement_list')]
    public function list(AbonnementRepository $abonnementRepository): Response
    {
        $abonnements = $abonnementRepository->findAll();
        $stripePublicKey = $this->getParameter('stripe_public_key');

        return $this->render('abonnement/index.html.twig', [
            'abonnements' => $abonnements,
            'stripe_public_key' => $stripePublicKey,
        ]);
    }

    #[Route('/panier/create', name: 'create_panier', methods: ['POST'])]
public function create(Request $request, EntityManagerInterface $entityManager): Response
{
    $data = $request->request->all();
    $abonnementId = $data['abonnements'][0] ?? null;

    if (!$abonnementId) {
        return new Response(json_encode(['error' => 'Aucun abonnement sélectionné.']), 400, ['Content-Type' => 'application/json']);
    }

    $abonnement = $entityManager->getRepository(Abonnement::class)->find($abonnementId);

    if (!$abonnement) {
        return new Response(json_encode(['error' => 'Aucun abonnement valide trouvé.']), 400, ['Content-Type' => 'application/json']);
    }

    $panier = new Panier();
    $panier->setCreatedAt(new \DateTimeImmutable());
    $panier->setIdProfile($this->getUser()->getProfile());
    $panier->setIdAbonnement($abonnement);

    $entityManager->persist($panier);
    try {
        $entityManager->flush();
    } catch (\Exception $e) {
        return new Response(json_encode(['error' => 'Échec de l\'enregistrement du panier.', 'details' => $e->getMessage()]), 500, ['Content-Type' => 'application/json']);
    }

    // Redirection vers la création de la session de paiement Stripe
    return $this->redirectToRoute('create_checkout_session', ['panierId' => $panier->getId()]);
}

}
