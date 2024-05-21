<?php

namespace App\Controller\Admin;

use App\Entity\DetailEntrainement;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DetailEntrainementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DetailEntrainement::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('day', 'Jour'),
            TextField::new('exercices'),
            TextField::new('series'),
            TextField::new('repetitions'),
            TextEditorField::new('description'),
            DateField::new('created_at')->hideOnForm(),
            DateField::new('updated_at')->hideOnForm(),
            AssociationField::new('idPlanEntrainement', 'Plan d\'entrainement'),
        ];
    }
}
