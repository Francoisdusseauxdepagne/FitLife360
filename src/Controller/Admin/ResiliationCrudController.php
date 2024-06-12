<?php

namespace App\Controller\Admin;

use App\Entity\Resiliation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ResiliationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Resiliation::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Résiliation(s)')
            ->setEntityLabelInSingular('une résiliation');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('objet', 'Objet'),
            TextEditorField::new('content', 'Demande de résiliation'),
            DateField::new('createdAt', 'Date de la demande'),
            TextField::new('idProfile', 'Profil du demandeur')
                ->formatValue(function ($value, $entity) {
                    return $entity->getIdProfile()->getFirstName() . ' ' . $entity->getIdProfile()->getName();
                }),
            EmailField::new('idProfile.idUser.email', 'Email de l\'utilisateur')
                ->formatValue(function ($value, $entity) {
                    return $entity->getIdProfile()->getIdUser()->getEmail();
                }),
            NumberField::new('idProfile.id', 'Identifiant du Profil'),
        ];
    }
}
