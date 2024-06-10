<?php

namespace App\Controller\Admin;

use App\Entity\Reporting;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReportingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reporting::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Signalement(s)')
            ->setEntityLabelInSingular('un signalement')
            ->setDefaultSort(['id' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('idProfile.firstname', 'Prénom du signaleur'),
            TextField::new('idProfile.name', 'Nom du signaleur'),
            TextField::new('comment', 'Commentaire de signalement'),
        ];
    }
}
