<?php

// Controller updated part
namespace App\Controller;

use App\Entity\Comment;
use App\Entity\TutoVideo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/comment/add', name: 'comment_add', methods: ['POST'])]
    public function addComment(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifier le type d'abonnement
        if (!$this->checkCommentSubscription()) {
            $this->addFlash('warning', 'Vous devez être abonné Premium ou VIP pour accéder aux vidéos sportives.');
            return $this->redirectToRoute('app_home');
        }

        $comment = new Comment();
        $comment->setText($request->request->get('comment'));
        $comment->setDate(new \DateTime());
        $comment->setIdTutoVideo($this->entityManager->getRepository(TutoVideo::class)->find($request->request->get('video_id')));
        $comment->setIdProfile($this->getUser()->getProfile());

        $this->entityManager->persist($comment);
        $this->entityManager->flush();

        $this->addFlash('success', 'Votre commentaire a été ajouté avec succès.');

        return $this->redirectToRoute('app_tuto_video');
    }

    #[Route('/comment/{id}/reply', name: 'comment_reply', methods: ['POST'])]
    public function replyComment(Request $request, Comment $comment): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifier le type d'abonnement
        if (!$this->checkCommentSubscription()) {
            $this->addFlash('warning', 'Vous devez être abonné Premium ou VIP pour accéder aux vidéos sportives.');
            return $this->redirectToRoute('app_home');
        }

        $reply = new Comment();
        $reply->setText($request->request->get('reply'));
        $reply->setDate(new \DateTime());
        $reply->setIdTutoVideo($comment->getIdTutoVideo());
        $reply->setIdProfile($this->getUser()->getProfile());
        $reply->setParent($comment);  // Setting the parent comment

        $this->entityManager->persist($reply);
        $this->entityManager->flush();

        $this->addFlash('success', 'Votre réponse a été ajoutée avec succès.');

        return $this->redirectToRoute('app_tuto_video');
    }

    #[Route('/comment/{id}/delete', name: 'comment_delete', methods: ['POST'])]
    public function deleteComment(Request $request, Comment $comment): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifier le type d'abonnement
        if (!$this->checkCommentSubscription()) {
            $this->addFlash('warning', 'Vous devez être abonné Premium ou VIP pour accéder aux vidéos sportives.');
            return $this->redirectToRoute('app_home');
        }

        $currentUserProfile = $this->getUser()->getProfile();

        if ($currentUserProfile === $comment->getIdProfile()) {
            $entityManager = $this->entityManager;
            $entityManager->remove($comment);
            $entityManager->flush();

            $this->addFlash('success', 'Le commentaire a été supprimé avec succès.');
        } else {
            $this->addFlash('danger', 'Vous ne pouvez pas supprimer ce commentaire.');
        }

        return $this->redirectToRoute('app_tuto_video');
    }

    private function checkCommentSubscription(): bool
    {
        $profile = $this->getUser()->getProfile();
        $subscriptionTitle = $profile->getIdAbonnement()->getTitle();

        return in_array($subscriptionTitle, ['Vip', 'Premium']);
    }
}
