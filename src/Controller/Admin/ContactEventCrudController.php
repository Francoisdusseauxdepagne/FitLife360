<?php

namespace App\Controller\Admin;

use App\Entity\ContactEvent;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ContactEventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ContactEvent::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'Identifiant de la demande'),
            TextField::new('content', 'Message'),
            DateField::new('createdAt', 'Date d\'envoie'),
            AssociationField::new('idEvent', 'identifiant de l\'Evènement'),
        ];
    }
}
