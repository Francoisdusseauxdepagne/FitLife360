<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use App\Controller\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class EventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Evènement(s)')
            ->setEntityLabelInSingular('un évènement');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('eventType', 'Type d\'évènement'),
            TextEditorField::new('description', 'Description'),
            DateField::new('date', 'Date de l\'évènement'),
            TimeField::new('startTime', 'Début de l\'évènement'),
            TimeField::new('endTime', 'Fin de l\'évènement'),
            AssociationField::new('idProfileCoach', 'Coach'),
            NumberField::new('participantMax', 'Nombre de participants'),
            NumberField::new('spaceAvailable', 'Place disponible'),
            ImageField::new('photo', 'Photo de profil')
                ->setBasePath('/images/photos')
                ->setUploadDir('public/images/photos')
                ->onlyOnIndex(),
            VichImageField::new('photoFile', 'Image')
                ->setTemplatePath('admin/field/vich_image_widget.html.twig')
                ->hideOnIndex(),
        ];
    }
}
