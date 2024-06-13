<?php

namespace App\Controller\Admin;

use App\Entity\TutoVideo;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TutoVideoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TutoVideo::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Vidéo(s) sportive(s)')
            ->setEntityLabelInSingular('une vidéo')
            ->setDefaultSort(['datePublication' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre'),
            TextEditorField::new('description', 'Description'),
            UrlField::new('url', 'Url'),
            DateField::new('datePublication', 'Date de publication'),
            TextField::new('temps', 'Durée de la video'),
        ];
    }
}
