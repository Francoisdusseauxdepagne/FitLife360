<?php

namespace App\Controller\Admin;

use App\Entity\TutoVideo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class TutoVideoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TutoVideo::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
            UrlField::new('url'),
            DateField::new('datePublication'),
        ];
    }
}
