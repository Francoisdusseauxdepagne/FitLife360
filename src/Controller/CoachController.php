<?php
namespace App\Controller;

use App\Entity\Messenger;
use App\Entity\ProfileCoach;
use App\Entity\PlanEntrainement;
use App\Entity\DetailEntrainement;
use App\Form\PlanEntrainementType;
use App\Form\ProfileTypeCoachType;
use App\Form\DetailEntrainementType;
use App\Repository\ProfileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoachController extends AbstractController
{
    private function calculateAge(\DateTimeImmutable $dateDeNaissance): int
    {
        $today = new \DateTimeImmutable();
        $age = $today->diff($dateDeNaissance)->y;

        return $age;
    }

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/coach', name: 'app_coach')]
    public function index(ProfileRepository $profileRepository): Response
    {
        $user = $this->getUser();
        $profile = $profileRepository->findAll();
        $profileCoach = $user->getProfileCoach();

        if ($user->isVerified() == false) {
            $this->addFlash('warning', 'Merci de confirmer votre adresse e-mail pour réaliser votre première connexion.');
            return $this->redirectToRoute('app_home');
        }

        if ($profileCoach === null) {
            return $this->redirectToRoute('app_edit_profileCoach');
        }

        return $this->render('coach/index.html.twig', [
            'controller_name' => 'CoachController',
            'profileCoach' => $profileCoach,
            'profiles' => $profile,
            'reservations' => $profileCoach->getReservations(),
        ]);
    }

    #[Route('/coach/edit', name: 'app_edit_profileCoach')]
    public function editProfile(Request $request): Response
    {
        $user = $this->getUser();
        $profileCoach = $user->getProfileCoach() ?? new ProfileCoach();

        $form = $this->createForm(ProfileTypeCoachType::class, $profileCoach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Calculer l'âge
            $dateDeNaissance = $form->get('dob')->getData();
            $age = $this->calculateAge($dateDeNaissance);

            // Vérifier que l'utilisateur a au moins 18 ans et pas plus de 80 ans
            if ($age < 18) {
                $this->addFlash('warning', 'Vous devez avoir au moins 18 ans pour créer un profil.');
                return $this->redirectToRoute('app_edit_profileCoach');
            } elseif ($age > 80) {
                $this->addFlash('warning', 'Vous ne pouvez pas avoir plus de 80 ans pour créer un profil.');
                return $this->redirectToRoute('app_edit_profileCoach');
            }

            $profileCoach->setIdUser($user);
            $profileCoach->setCreatedAt(new \DateTimeImmutable());
            $profileCoach->setIsActive(true);

            $this->entityManager->persist($profileCoach);
            $this->entityManager->flush();

            $this->addFlash('success', 'Profil Coach créé avec succès !');
            return $this->redirectToRoute('app_coach');
        }

        return $this->render('coach/editCoach.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/coach/update', name: 'app_update_coach')]
    public function updateCoach(Request $request): Response
    {
        $user = $this->getUser();
        $profileCoach = $user->getProfileCoach();

        $form = $this->createForm(ProfileTypeCoachType::class, $profileCoach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($profileCoach);
            $this->entityManager->flush();
            $this->addFlash('success', 'Mon profil mis à jour avec succès !');
            return $this->redirectToRoute('app_coach');
        }

        return $this->render('coach/updateProfile.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/coach/create-entrainement', name: 'app_coach_create_entrainement')]
    public function createEntrainement(Request $request): Response
    {
        $user = $this->getUser();
        $profileCoach = $user->getProfileCoach();

        $planEntrainement = new PlanEntrainement();
        $form = $this->createForm(PlanEntrainementType::class, $planEntrainement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planEntrainement->setIdProfileCoach($profileCoach);
            $planEntrainement->setCreatedAt(new \DateTimeImmutable());
            $planEntrainement->setUpdatedAt(new \DateTimeImmutable());

            $this->entityManager->persist($planEntrainement);
            $this->entityManager->flush();

            $this->addFlash('success', 'Plan d\'entraînement créé avec succès !');

            // Redirection vers la page de détails de l'entraînement nouvellement créé
            return $this->redirectToRoute('app_coach_detail_entrainement', ['id' => $planEntrainement->getId()]);
        }

        return $this->render('coach/createEntrainement.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/coach/detail-entrainement/{id}', name: 'app_coach_detail_entrainement')]
    public function detailEntrainement($id, Request $request): Response
    {
        $planEntrainement = $this->entityManager->getRepository(PlanEntrainement::class)->find($id);

        if (!$planEntrainement) {
            throw $this->createNotFoundException('Plan d\'entraînement non trouvé');
        }

        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        // Récupérer le profil associé à l'utilisateur connecté
        $profile = $user->getProfile();

        // Créer un nouveau détail d'entraînement et associer les entités liées
        $detailEntrainement = new DetailEntrainement();
        $detailEntrainement->setIdProfileCoach($user->getProfileCoach());
        $detailEntrainement->setIdProfile($profile);
        $detailEntrainement->setIdPlanEntrainement($planEntrainement);

        // Créer le formulaire pour le détail d'entraînement
        $form = $this->createForm(DetailEntrainementType::class, $detailEntrainement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $detailEntrainement->setCreatedAt(new \DateTimeImmutable());
            $detailEntrainement->setUpdatedAt(new \DateTimeImmutable());

            $this->entityManager->persist($detailEntrainement);
            $this->entityManager->flush();

            $this->addFlash('success', 'Détail d\'entraînement pour le ' . $detailEntrainement->getExercices() . ' ajouté avec succès !');

            // Redirection vers la même page pour afficher le nouveau détail d'entraînement
            return $this->redirectToRoute('app_coach_detail_entrainement', ['id' => $id]);
        }

        // Récupérer les détails d'entraînement existants pour le plan d'entraînement
        $detailsEntrainement = $this->entityManager->getRepository(DetailEntrainement::class)->findBy(['idPlanEntrainement' => $planEntrainement]);

        return $this->render('coach/detailEntrainement.html.twig', [
            'planEntrainement' => $planEntrainement,
            'form' => $form->createView(),
            'detailsEntrainement' => $detailsEntrainement, // Passer les détails d'entraînement à la vue
        ]);
    }

    #[Route('/coach/entrainements/', name: 'app_coach_list_entrainements')]
    public function listEntrainements(): Response
    {
        // Récupérer tous les programmes d'entraînement avec leurs détails
        $planEntrainements = $this->entityManager->getRepository(PlanEntrainement::class)->findAll();

        return $this->render('coach/listEntrainements.html.twig', [
            'planEntrainements' => $planEntrainements,
        ]);
    }

    #[Route('/coach/update-entrainement/{id}', name: 'app_coach_update_entrainement')]
    public function updateEntrainement($id, Request $request): Response
    {
        $planEntrainement = $this->entityManager->getRepository(PlanEntrainement::class)->find($id);

        if (!$planEntrainement) {
            throw $this->createNotFoundException('Plan d\'entraînement non trouvé');
        }

        // Créer le formulaire pour le plan d'entraînement
        $form = $this->createForm(PlanEntrainementType::class, $planEntrainement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planEntrainement->setUpdatedAt(new \DateTimeImmutable());

            $this->entityManager->flush();

            $this->addFlash('success', 'Plan d\'entraînement mis à jour avec succès !');

            // Redirection vers la page de détails de l'entraînement
            return $this->redirectToRoute('app_coach_list_entrainements', ['id' => $id]);
        }

        return $this->render('coach/updateEntrainement.html.twig', [
            'planEntrainement' => $planEntrainement,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/coach/update-detail-entrainement/{id}', name: 'app_coach_update_detail_entrainement')]
    public function updateDetailEntrainement($id, Request $request): Response
    {
        $detailEntrainement = $this->entityManager->getRepository(DetailEntrainement::class)->find($id);

        if (!$detailEntrainement) {
            throw $this->createNotFoundException('Détail d\'entraînement non trouvé');
        }

        // Créer le formulaire pour le détail d'entraînement
        $form = $this->createForm(DetailEntrainementType::class, $detailEntrainement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $detailEntrainement->setUpdatedAt(new \DateTimeImmutable());

            $this->entityManager->flush();

            $this->addFlash('success', 'Détail d\'entraînement mis à jour avec succès !');

            // Redirection vers la page de détails de l'entraînement
            return $this->redirectToRoute('app_coach_detail_entrainement', ['id' => $detailEntrainement->getIdPlanEntrainement()->getId()]);
        }

        return $this->render('coach/updateDetailEntrainement.html.twig', [
            'detailEntrainement' => $detailEntrainement,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/coach/delete-detail-entrainement/{id}', name: 'app_coach_delete_detail_entrainement', methods: ['POST'])]
    public function deleteDetailEntrainement($id, Request $request): Response
    {
        $detailEntrainement = $this->entityManager->getRepository(DetailEntrainement::class)->find($id);

        if (!$detailEntrainement) {
            throw $this->createNotFoundException('Détail d\'entraînement non trouvé');
        }

        $this->entityManager->remove($detailEntrainement);
        $this->entityManager->flush();

        $this->addFlash('success', 'Détail d\'entraînement supprimé avec succès !');

        // Redirection vers la liste des programmes d'entraînement ou la page précédente
        return $this->redirectToRoute('app_coach_list_entrainements');
    }

    #[Route('/coach/delete-entrainement/{id}', name: 'app_coach_delete_entrainement', methods: ['POST'])]
    public function deleteEntrainement($id, Request $request): Response
    {
        $planEntrainement = $this->entityManager->getRepository(PlanEntrainement::class)->find($id);

        if (!$planEntrainement) {
            throw $this->createNotFoundException('Plan d\'entraînement non trouvé');
        }

        $this->entityManager->remove($planEntrainement);
        $this->entityManager->flush();

        $this->addFlash('success', 'Plan d\'entraînement supprimé avec succès !');

        // Redirection vers la liste des programmes d'entraînement ou la page précedente
        return $this->redirectToRoute('app_coach_list_entrainements');
    }
}
