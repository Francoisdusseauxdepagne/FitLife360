<?php

namespace App\Controller\Admin;

use App\Entity\ContactEvent;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactEventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ContactEvent::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Réservation événement') 
            ->setEntityLabelInSingular('une demande');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('content', 'Message'),
            DateField::new('createdAt', 'Date d\'envoie'),
            AssociationField::new('idEvent', 'Evènement'),
            AssociationField::new('idProfile', 'identifiant du Profil'),
        ];
    }
}
