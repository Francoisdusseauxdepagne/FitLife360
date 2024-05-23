<?php

namespace App\Form;

use App\Entity\Profile;
use App\Entity\ProfileCoach;
use App\Entity\Reservation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', null, [
                'widget' => 'single_text',
                'label' => 'Date du rendez-vous',
            ])
            ->add('startTime', null, [
                'widget' => 'single_text',
                'label' => 'Heure du rendez-vous',
            ])
            ->add('idProfile', EntityType::class, [
                'class' => Profile::class,
                'choice_label' => 'firstName',
                'label' => 'Mon profil',
            ])
            ->add('idProfileCoach', EntityType::class, [
                'class' => ProfileCoach::class,
                'choice_label' => 'firstName',
                'label' => 'Mon coach',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
