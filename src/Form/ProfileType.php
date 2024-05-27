<?php

namespace App\Form;

use App\Entity\Coach;
use App\Entity\Profile;
use App\Entity\ProfileCoach;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, ['label' => 'Nom'])
            ->add('firstName', null, ['label' => 'Prénom'])
            // ->add('age', null, [
            //     'label' => 'Ton Age',
            // ])
            ->add('photoFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Effacer',
                'download_label' => 'Télécharger',
                'download_uri' => true,
                'image_uri' => true,
                'asset_helper' => true,
                'label' => 'Photo de profil',
            ])
            ->add('sexe', ChoiceType::class, [
                'label' => 'Sexe',
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme'
                ],
                'placeholder' => 'Choisissez votre sexe',
            ])
            ->add('objectifSportif', ChoiceType::class, [
                'label' => 'Objectif sportif',
                'choices' => [
                    'Prise de muscle' => 'Prise de muscle',
                    'Maintien' => 'Maintien',
                    'Perte de poids' => 'Perte de poids',
                ],
                'placeholder' => 'Choisissez votre objectif sportif',
            ])
            ->add('bio', null, ['label' => 'Dites en plus sur vous'])
            ->add('idProfileCoach', EntityType::class, [
                'class' => ProfileCoach::class,
                'choice_label' => 'firstName',
                'label' => 'Mon coach',
                'placeholder' => 'Choisissez votre coach',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
        ]);
    }
}
