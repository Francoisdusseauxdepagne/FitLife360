<?php

namespace App\Controller;

use Stripe\Stripe;
use Stripe\Webhook;
use App\Entity\Panier;
use App\Entity\Invoice;
use Stripe\StripeClient;
use Psr\Log\LoggerInterface;
use Stripe\Checkout\Session;
use App\Repository\PanierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PaymentController extends AbstractController
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    #[Route('/create-checkout-session/{panierId}', name: 'create_checkout_session', methods: ['GET'])]
public function createCheckoutSession(int $panierId, EntityManagerInterface $entityManager, StripeClient $stripeClient): Response
{
    $panier = $entityManager->getRepository(Panier::class)->find($panierId);

    if (!$panier) {
        return new Response(json_encode(['error' => 'Panier non trouvé.']), 404, ['Content-Type' => 'application/json']);
    }

    $abonnement = $panier->getIdAbonnement();
    if (!$abonnement) {
        return new Response(json_encode(['error' => 'Aucun article à payer dans le panier.']), 400, ['Content-Type' => 'application/json']);
    }

    $session = $stripeClient->checkout->sessions->create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => $abonnement->getTitle(),
                ],
                'unit_amount' => $abonnement->getPrix() * 100, // en centimes
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => $this->generateUrl('payment_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
        'cancel_url' => $this->generateUrl('payment_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
    ]);

    $panier->setStripeSessionId($session->id);
    $entityManager->flush();

    return new JsonResponse(['id' => $session->id]);
}


    #[Route('/payment-success', name: 'payment_success')]
    public function paymentSuccess(): Response
    {
        return $this->render('payment/success.html.twig');
    }

    #[Route('/payment-cancel', name: 'payment_cancel')]
    public function paymentCancel(): Response
    {
        return $this->render('payment/cancel.html.twig');
    }

    #[Route('/webhook', name: 'stripe_webhook')]
    public function stripeWebhook(Request $request, PanierRepository $panierRepository, EntityManagerInterface $em): Response
    {
        $payload = @file_get_contents('php://input');
        $sigHeader = $request->headers->get('stripe-signature');
        $endpointSecret = $this->getParameter('stripe_webhook_secret');

        $this->logger->info('Webhook reçu', ['payload' => $payload, 'signature' => $sigHeader]);

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
            $this->logger->info('Événement Webhook construit', ['event' => $event]);
        } catch (\UnexpectedValueException $e) {
            $this->logger->error('Payload invalide', ['exception' => $e]);
            return new Response('Payload invalide', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            $this->logger->error('Signature invalide', ['exception' => $e]);
            return new Response('Signature invalide', 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;

            $this->logger->info('Session de paiement complétée', ['sessionId' => $session->id]);

            $panier = $panierRepository->findOneBy(['stripeSessionId' => $session->id]);

            if ($panier) {
                $panier->setIsPaid(true);

                $profile = $panier->getIdProfile();
                if ($profile) {
                    $profile->setIdAbonnement($panier->getIdAbonnement());
                    $em->persist($profile);
                }

                $invoice = new Invoice();
                $invoice->setCreatedAt(new \DateTimeImmutable());
                $invoice->setIdPanier($panier);
                $invoice->setAmount($panier->getIdAbonnement()->getPrix()); // Assurez-vous que `getPrix` existe sur `Abonnement`

                $em->persist($invoice);
                $em->persist($panier);
                $em->flush();

                $this->logger->info('Panier, facture et profil mis à jour', ['panierId' => $panier->getId(), 'invoiceId' => $invoice->getId(), 'profileId' => $profile->getId()]);
            } else {
                $this->logger->error('Panier non trouvé', ['stripeSessionId' => $session->id]);
                return new Response('Panier non trouvé', 404);
            }
        }

        return new Response('Succès', 200);
    }
}
