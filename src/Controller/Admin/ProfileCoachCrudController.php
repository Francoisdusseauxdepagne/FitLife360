<?php

namespace App\Controller\Admin;

use App\Entity\ProfileCoach;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProfileCoachCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProfileCoach::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstname'),
            TextField::new('name'),
            DateField::new('dob'),
            TextField::new('diplome'),
            TextEditorField::new('experience'),
            TextField::new('photo'),
            TextField::new('genre'),
            TextEditorField::new('bio'),
            DateField::new('createdAt'),
            TextField::new('contrat'),
        ];
    }
}
