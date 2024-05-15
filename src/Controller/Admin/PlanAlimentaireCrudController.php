<?php

namespace App\Controller\Admin;

use App\Entity\PlanAlimentaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PlanAlimentaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PlanAlimentaire::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextEditorField::new('description'),
            DateField::new('dateDebut'),
            DateField::new('dateFin'),
        ];
    }
}
