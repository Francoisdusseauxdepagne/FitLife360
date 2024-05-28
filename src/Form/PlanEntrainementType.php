<?php

namespace App\Form;

use App\Entity\Profile;
use App\Entity\ProfileCoach;
use App\Entity\PlanEntrainement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PlanEntrainementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre du programme',
            ])
            ->add('description', null, [
                'label' => 'Description du programme',
            ])
            ->add('duree', null, [
                'label' => 'Duree du programme',
            ])
            ->add('objectif', null, [
                'label' => 'Objectif du client',
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type du programme',
                'choices' => [
                    '' => '',
                    'Musculation' => 'Musculation',
                    'Hydride' => 'Cardio-training',
                    'Cardio' => 'Cardio',
                ],
            ])
            ->add('niveau', ChoiceType::class, [
                'label' => 'Niveau du client',
                'choices' => [
                    '' => '',
                    'Debutant' => 'Debutant',
                    'Intermediaire' => 'Intermediaire',
                    'Avance' => 'Avance',
                ],
            ])
            ->add('idProfile', EntityType::class, [
                'class' => Profile::class,
                'label' => 'Client',
                'choice_label' => 'firstName',
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlanEntrainement::class,
        ]);
    }
}
