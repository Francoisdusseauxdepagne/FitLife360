<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AvisController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // #[Route('/avis', name: 'app_avis')]
    // public function index(AvisRepository $avisRepository): Response
    // {
    //     $avis = $avisRepository->findAll();

    //     return $this->render('avis/index.html.twig', [
    //         'avis' => $avis,
    //     ]);
    // }

    // route pour supprimer un avis
    #[Route('/avis/delete/{id}', name: 'app_avis_delete')]
    public function delete(Avis $avis, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $currentUser = $this->getUser()->getProfile();

        if ($currentUser === $avis->getIdProfile()) {
        $entityManager->remove($avis);
        $entityManager->flush();
        $this->addFlash('success', 'L\'avis a été supprimé avec succès.');
        } else {
            $this->addFlash('danger', 'Vous ne pouvez pas supprimer cet avis.');
        }

        // Rediriger vers la page d'accueil
        return $this->redirectToRoute('app_home');
    }

    #[Route('/avis/add', name: 'app_avis_add')]
    public function add(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        
        $avis = new Avis();

        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $profile = $user->getProfile();
            $avis->setIdProfile($profile);
            $avis->setCreatedAt(new \DateTimeImmutable());

            $entityManager = $this->entityManager;
            $entityManager->persist($avis);
            $entityManager->flush();

            $this->addFlash('success', 'Votre avis a été ajouté avec succès.');

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('avis/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
