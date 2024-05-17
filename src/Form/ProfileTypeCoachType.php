<?php

namespace App\Form;

use App\Entity\ProfileCoach;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProfileTypeCoachType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('dob', null, [
                'widget' => 'single_text',
                'label' => 'Date de naissance',
            ])
            ->add('diplome' , null, [
                'label' => 'Vos diplômes et certifications',
            ])
            ->add('experience' , null, [
                'label' => 'Votre expérience sportive',
            ])
            ->add('photo')
            ->add('genre', ChoiceType::class, [
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme'
                ]
            ])
            ->add('bio', null, [
                'label' => 'Biographie',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProfileCoach::class,
        ]);
    }
}
