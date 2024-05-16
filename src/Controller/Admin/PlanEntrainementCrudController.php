<?php

namespace App\Controller\Admin;

use App\Entity\PlanEntrainement;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PlanEntrainementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PlanEntrainement::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextEditorField::new('description'),
            TextField::new('duree'),
            TextField::new('objectif'),
            TextField::new('type'),
            TextField::new('niveau'),
            DateField::new('createdAt'),
            DateField::new('updatedAt'),
            AssociationField::new('idProfile', 'Id du Profil'),
        ];
    }
}
