<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Event;
use App\Entity\Panier;
use App\Entity\Comment;
use App\Entity\Contact;
use App\Entity\Invoice;
use App\Entity\Profile;
use App\Entity\Reporting;
use App\Entity\TutoVideo;
use App\Entity\Abonnement;
use App\Entity\Reservation;
use App\Entity\Resiliation;
use App\Entity\ContactEvent;
use App\Entity\ProfileCoach;
use App\Entity\PlanEntrainement;
use App\Entity\DetailEntrainement;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        # return parent::index();
        return $this->render('admin/index.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration du site');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Liens');
        yield MenuItem::linkToRoute('Retour à l\'accueil', 'fa fa-home', 'app_home');
        yield MenuItem::linkToDashboard('Retour Dashboard', 'fa-solid fa-user-tie');
        yield MenuItem::section('Gestion des messages');
        yield MenuItem::linkToCrud('Message', 'fa-solid fa-message', Contact::class);
        yield MenuItem::linkToCrud('Resiliation', "fa-solid fa-envelope", Resiliation::class);
        yield MenuItem::section('Vues pages');
        yield MenuItem::linkToRoute('Profil Utilisateur', 'fa-solid fa-eye', 'app_profile');
        yield MenuItem::linkToRoute('profil Coach', 'fa-solid fa-eye', 'app_coach');
        yield MenuItem::linkToRoute('Abonnement', "fa-brands fa-shopify", 'abonnement_list');
        yield MenuItem::linkToRoute('A propos', 'fa-solid fa-address-card', 'app_apropos');
        yield MenuItem::linkToRoute('Vidéos', 'fa-solid fa-film', 'app_tuto_video');
        yield MenuItem::section('Gestion des Utilisateurs');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Membres', 'fa-solid fa-user', Profile::class);
        yield MenuItem::section('Gestion des abonnements');
        yield MenuItem::linkToCrud('Abonnements', 'fa-solid fa-credit-card', Abonnement::class);
        yield MenuItem::linkToCrud('Panier', 'fa-solid fa-cart-plus', Panier::class);
        yield MenuItem::linkToCrud('Factures', 'fa-solid fa-file-invoice', Invoice::class);
        yield MenuItem::section('Gestion des Collaborateur');
        yield MenuItem::linkToCrud('Collaborateurs', 'fa-solid fa-people-group', ProfileCoach::class);
        yield MenuItem::section('Gestion des Videos sportives');
        yield MenuItem::linkToCrud('Videos sportives', 'fa-solid fa-film', TutoVideo::class);
        yield MenuItem::linkToCrud('Commentaires', 'fa-solid fa-comment', Comment::class);
        yield MenuItem::linkToCrud('Signalement', 'fa-solid fa-flag', Reporting::class);
        yield MenuItem::section('Gestion des programmes');
        yield MenuItem::linkToCrud('Plan d\'entrainement', 'fa-solid fa-dumbbell', PlanEntrainement::class);
        yield MenuItem::linkToCrud('Détail d\'entrainement', 'fa-solid fa-dumbbell', DetailEntrainement::class);
        yield MenuItem::section('Gestion des Reservations');
        yield MenuItem::linkToCrud('Reservation', 'fa-solid fa-calendar-days', Reservation::class);
        yield MenuItem::section('Gestion des Evènements');
        yield MenuItem::linkToCrud('Evènements', 'fa-solid fa-calendar-days', Event::class);
        yield MenuItem::linkToCrud('Demande de reservation', 'fa-solid fa-envelope', ContactEvent::class);
    }
}