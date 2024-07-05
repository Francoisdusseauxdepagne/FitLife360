<?php

namespace App\Controller\Admin;

use App\Entity\ContactCoach;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactCoachCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ContactCoach::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Contacts Coach')
            ->setEntityLabelInSingular('un contact')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('idProfile', 'Profil'),
            AssociationField::new('idProfileCoach', 'Coach'),
            TextField::new('objet'),
            TextField::new('content'),
            DateField::new('createdAt'),
            TextField::new('email', 'Email'),
            TextField::new('firstName', 'Prénom'),
            TextField::new('name', 'Nom'),
        ];
    }
}
