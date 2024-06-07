<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Commentaire(s)');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('text', 'Commentaire'),
            DateField::new('date', 'Date du commentaire'),
            TextField::new('idProfile.firstname', 'Prénom du Profil'),
            TextField::new('idProfile.name', 'Nom du Profil'),
            TextField::new('idTutoVideo.title', 'Video'),
            EmailField::new('idProfile.idUser.email', 'Email utilisateur'),
        ];
    }
}
