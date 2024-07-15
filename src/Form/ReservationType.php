<?php

namespace App\Form;

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
            ->add('idProfileCoach', EntityType::class, [
                'class' => ProfileCoach::class,
                'label' => 'Mon coach',
                'choice_label' => 'firstName',
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'      => Reservation::class,
            // enable/disable CSRF protection for this form
            'csrf_protection' => true,
            // the name of the hidden HTML field that stores the token
            'csrf_field_name' => '_token',
            // an arbitrary string used to generate the value of the token
            // using a different string for each form improves its security
            'csrf_token_id'   => 'reservation_item',
        ]);
    }
}
