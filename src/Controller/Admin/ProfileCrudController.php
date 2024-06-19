<?php

namespace App\Controller\Admin;

use App\Entity\Profile;
use App\Controller\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProfileCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Profile::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Membre(s)')
            ->setEntityLabelInSingular('un membre');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('idUser', 'Email de l\'utilisateur')
                ->formatValue(function ($value, $entity) {
                    return $entity->getIdUser()->getEmail();
            }),
            TextField::new('firstname', 'Prénom'),
            TextField::new('name', 'Nom'),
            DateField::new('dateDeNaissance', 'Date de naissance'),
            TextField::new('sexe', 'Sexe'),
            TextField::new('objectifSportif', 'Objectif sportif'),
            TextEditorField::new('bio', 'Biographie'),
            DateTimeField::new('createdAt', 'Créé le'),
            ImageField::new('photo', 'Photo de profil')
                ->setBasePath('/images/photos')
                ->setUploadDir('public/images/photos')
                ->onlyOnIndex(),
            VichImageField::new('photoFile', 'Image')
                ->setTemplatePath('admin/field/vich_image_widget.html.twig')
                ->hideOnIndex(),
            AssociationField::new('idAbonnement', 'Abonnement'),
            AssociationField::new('idProfileCoach', 'Coach'),
            BooleanField::new('isActive', 'Profil actif'),
        ];
    }
}