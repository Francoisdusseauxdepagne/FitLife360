<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Repository\AbonnementRepository;
use App\Repository\PanierRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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
        $profile = $user->getProfile();
        $panier = new Panier();
        $panier->setCreatedAt(new DateTimeImmutable());
        $panier->setIdAbonnement($abonnement);
        $panier->setIdProfile($profile);
        $profile->setIdAbonnement($abonnement);
        $this->entityManager->persist($profile);
        

        // Sauvegarder le panier en base de données
        $this->entityManager->persist($panier);
        $this->entityManager->flush();

        // Rediriger l'utilisateur vers la page du panier
        return $this->redirectToRoute('panier');
    }

    #[Route('/panier', name: 'panier')]
    public function showPanier(PanierRepository $panierRepository): Response
    {
        $user = $this->getUser();
       

        // Récupérer le dernier panier créé pour cet utilisateur
        $panier = $panierRepository->findOneBy(
            ['idProfile' => $user->getProfile()],
            ['createdAt' => 'DESC'] // Tri par date de création décroissante pour obtenir le dernier panier
        );

        // Vous pouvez aussi récupérer tous les paniers associés à cet utilisateur pour un traitement plus avancé
        // $paniers = $entityManager->getRepository(Panier::class)->findBy(['idProfile' => $user->getProfile()], ['createdAt' => 'DESC']);

        $abonnement = $panier ? $panier->getIdAbonnement() : null;

        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
            'abonnement' => $abonnement,
        ]);
    }

    #[Route('/paid/{id}', name: 'app_pay', methods: ['POST'])]
    public function pay(int $id, AbonnementRepository $abonnementRepository, EntityManagerInterface $entityManager,PanierRepository $panierRepository): Response
    {
        $user = $this->getUser();
        $abonnement = $abonnementRepository->find($id);

        if (!$abonnement) {
            throw $this->createNotFoundException('Produit non trouvé');
        }

        // Initialiser Stripe
        Stripe::setApiKey($this->getParameter('stripe_secret_key'));

        // Créer une session de paiement
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $abonnement->getTitle(),
                    ],
                    'unit_amount' => $abonnement->getPrix() * 100, // En centimes
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('app_pay_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('app_pay_cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        // Recherche du panier de l'utilisateur
        $panier = $panierRepository->findOneBy(
            ['idProfile' => $user->getProfile()],
            ['createdAt' => 'DESC'] // Tri par date de création décroissante pour obtenir le dernier panier
        );

        if ($panier) {
            $panier->setIsPaid(true);
            $entityManager->flush();
        }

        return $this->redirect($session->url, 303);
    }

    #[Route('/pay/success', name: 'app_pay_success')]
    public function paySuccess(PanierRepository $panierRepository): Response
    {
        $user = $this->getUser();
        $profile = $user->getProfile();

        // Recherche du panier de l'utilisateur
        $panier = $panierRepository->findOneBy(
            ['idProfile' => $user->getProfile()],
            ['createdAt' => 'DESC'] // Tri par date de création décroissante pour obtenir le dernier panier
        );

        if ($panier && $panier->isPaid()) {
            // Mettre à jour le profil avec l'abonnement choisi
            $profile->setIdAbonnement($panier->getIdAbonnement());
            $this->entityManager->flush();

            $this->addFlash('success', 'Votre paiement a été effectué avec succès.');
        } else {
            $this->addFlash('error', 'Erreur lors de la mise à jour du profil.');
        }

        // // Supprimer le panier du profil quand il paiement est valide
        // if ($panier) {
        //     $this->entityManager->remove($panier);
        //     $this->entityManager->flush();
        // }

        return $this->redirectToRoute('app_profile');
    }

    #[Route('/pay/cancel', name: 'app_pay_cancel')]
    public function payCancel(): Response
    {
        // Logique en cas d'annulation
        return $this->redirectToRoute('app_panier');
    }
}
