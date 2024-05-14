<?php

namespace App\Controller\Admin;

use App\Entity\Profile;
use App\Controller\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProfileCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Profile::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('sexe'),
            TextField::new('objectifSportif'),
            TextEditorField::new('bio'),
            DateTimeField::new('createdAt', 'Créé le')->setFormTypeOptions([
                'disabled' => true,
            ]),
            ImageField::new('photo', 'Photo')
                ->setBasePath('/images/photos')
                ->setUploadDir('public/images/photos')
                ->onlyOnIndex(),
            VichImageField::new('photoFile', 'Image File')
                ->setTemplatePath('admin/field/vich_image_widget.html.twig')
                ->hideOnIndex(),
        ];
    }
}