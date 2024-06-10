<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class ReservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Reservation(s)')
            ->setEntityLabelInSingular('une reservation');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('idProfile', 'Prénom du sportif')
                ->formatValue(function ($value, $entity) {
                    return $entity->getIdProfile()->getFirstName();
                }),
            AssociationField::new('idProfileCoach', 'Prénom du Coach')
                ->formatValue(function ($value, $entity) {
                    return $entity->getIdProfileCoach()->getFirstName();
                }),
            DateField::new('date', 'Date'),
            TimeField::new('startTime', 'Heure de la reservation'),
        ];
    }
}
