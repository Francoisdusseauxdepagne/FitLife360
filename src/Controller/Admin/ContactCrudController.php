<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Contact(s)')
            ->setEntityLabelInSingular('un contact')
            ->setDefaultSort(['id' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('objet', 'Objet'),
            TextEditorField::new('text', 'Texte'),
            TextField::new('email', 'Email'),
            TextField::new('name', 'Nom'),
            TextField::new('firstname', 'Prénom'),
            TextField::new('idProfile', 'Identifiant du Profil'),
        ];
    }
}
