<?php

namespace App\Controller\Admin;

use App\Entity\Abonnement;
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

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextEditorField::new('description'),
            NumberField::new('prix'),
            NumberField::new('vente'),
        ];
    }
}
