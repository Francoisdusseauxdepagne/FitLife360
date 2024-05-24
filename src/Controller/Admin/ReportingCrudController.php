<?php

namespace App\Controller\Admin;

use App\Entity\Reporting;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReportingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reporting::class;
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
