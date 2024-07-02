<?php

namespace App\Controller\Admin;

use App\Entity\Avis;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class AvisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Avis::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Avis')
            ->setEntityLabelInSingular('un avis');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id', 'Numero de l\'avis'),
            NumberField::new('note', 'Note /5'),
            TextField::new('content', 'Commentaire'),
            AssociationField::new('idProfile', 'Identifiant du Profil'),
            DateField::new('createdAt', 'Date de création'),
        ];
    }
}
