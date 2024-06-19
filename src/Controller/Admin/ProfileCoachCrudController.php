<?php

namespace App\Controller\Admin;

use App\Entity\ProfileCoach;
use App\Controller\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProfileCoachCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProfileCoach::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Collaborateur(s)') 
            ->setEntityLabelInSingular('un collaborateur');
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
            DateField::new('dob', 'Date de Naissance'),
            TextField::new('diplome', 'Diplome(s)'),
            TextField::new('experience', 'Experience(s)'),
            TextField::new('expertise', 'Expertise(s)'),
            ImageField::new('photo', 'Photo profil coach')
            ->setBasePath('/images/photos')
            ->setUploadDir('public/images/photos')
            ->onlyOnIndex(),
            VichImageField::new('photoFile', 'Image')
            ->setTemplatePath('admin/field/vich_image_widget.html.twig')
            ->hideOnIndex(),            
            TextField::new('genre', 'Sexe'),
            TextField::new('bio', 'Biographie'),
            DateTimeField::new('createdAt', 'Créé le'),
            TextField::new('contrat', 'Contrat'),
            BooleanField::new('isActive', 'Actif'),
        ];
    }
}