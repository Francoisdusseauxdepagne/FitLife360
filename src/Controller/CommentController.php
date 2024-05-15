<?php

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

    #[Route('/comment/{id}/delete', name: 'comment_delete', methods: ['POST'])]
    public function deleteComment(Request $request, Comment $comment): Response
    {
        $entityManager = $this->entityManager;
        $entityManager->remove($comment);
        $entityManager->flush();

        $this->addFlash('success', 'Le commentaire a été supprimé avec succès.');

        return $this->redirectToRoute('app_tuto_video');
    }
}
