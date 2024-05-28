<?php

namespace App\Form;

use App\Entity\Profile;
use App\Entity\PlanEntrainement;
use App\Entity\DetailEntrainement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DetailEntrainementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('day', ChoiceType::class, [
            'label' => 'Jour',
            'choices' => [
                'Lundi' => 'Lundi',
                'Mardi' => 'Mardi',
                'Mercredi' => 'Mercredi',
                'Jeudi' => 'Jeudi',
                'Vendredi' => 'Vendredi',
                'Samedi' => 'Samedi',
                'Dimanche' => 'Dimanche',
            ],
            ])
            ->add('echauffement', null, [
                'label' => 'Echauffement',
            ])
            ->add('exercices', null, [
                'label' => 'Exercices',
            ])
            ->add('series', null, [
                'label' => 'Séries',
            ])
            ->add('repetitions', null, [
                'label' => 'Repetitions',
            ])
            ->add('description', null, [
                'label' => 'Description',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DetailEntrainement::class,
        ]);
    }
}
