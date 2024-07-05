<?php

namespace App\Controller\Admin;

use App\Entity\PlanEntrainement;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
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

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Plan d\'Entrainement')
            ->setEntityLabelInSingular('un plan d\'entrainement')
            ->setDefaultSort(['id' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Nom du Plan d\'Entrainement'),
            TextField::new('description', 'Description'),
            TextField::new('duree', 'Durée'),
            TextField::new('objectif', 'Objectif'),
            TextField::new('type', 'Type d\'Entrainement'),
            TextField::new('niveau', 'Niveau'),
            DateField::new('createdAt', 'Créé le'),
            AssociationField::new('idProfile', 'Identifiant du Profil'),
        ];
    }
}
