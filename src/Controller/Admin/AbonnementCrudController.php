<?php

namespace App\Controller\Admin;

use App\Entity\Abonnement;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AbonnementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Abonnement::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Abonnement(s)')
            ->setEntityLabelInSingular('un abonnement');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Nom de la formule'),
            TextEditorField::new('description', 'Description'),
            NumberField::new('prix', 'Prix'),
            TextField::new('duree', 'Duree')
        ];
    }
}
