<?php

namespace App\Controller\Admin;

use App\Entity\Trip;
use App\Entity\User;
use App\Entity\Profile;
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
        yield MenuItem::section('Liens utiles');
        yield MenuItem::linkToRoute('Retour à l\'accueil', 'fa fa-home', 'app_home');
        yield MenuItem::linkToDashboard('Retour Dashboard', 'fa-solid fa-user-tie');
        yield MenuItem::linkToRoute('Vue page profile', 'fa-solid fa-eye', 'app_profile');
        yield MenuItem::section('Geston des Utilisateurs');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Profils', 'fa-regular fa-address-card', Profile::class);
    }
}