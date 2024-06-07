<?php

namespace App\Controller\Admin;

use App\Entity\ProfileCoach;
use App\Controller\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\SortOrder;
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
            ->setDefaultSort(['createdAt' => SortOrder::DESC]);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstname', 'Prénom'),
            TextField::new('name', 'Nom'),
            DateField::new('dob', 'Date de Naissance'),
            TextField::new('diplome', 'Diplome(s)'),
            TextEditorField::new('experience', 'Experience(s)'),
            ImageField::new('photo', 'Photo profil coach')
            ->setBasePath('/images/photos')
            ->setUploadDir('public/images/photos')
            ->onlyOnIndex(),
            VichImageField::new('photoFile', 'Image File')
            ->setTemplatePath('admin/field/vich_image_widget.html.twig')
            ->hideOnIndex(),            
            TextField::new('genre', 'Sexe'),
            TextEditorField::new('bio', 'Biographie'),
            DateField::new('createdAt', 'Créé le'),
            TextField::new('contrat', 'Contrat'),
        ];
    }
}