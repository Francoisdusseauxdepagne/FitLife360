<?php

namespace App\Controller\Admin;

use App\Entity\Reporting;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

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
            AssociationField::new('idProfile', 'Signaleur'),
            TextField::new('comment', 'Commentaire du signaleur'),
            AssociationField::new('idComment', 'Commentaire signalé'),
            DateField::new('createdAt', 'Date du signalement'),
        ];
    }
}
