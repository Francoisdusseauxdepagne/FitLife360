<?php

namespace App\Form;

use App\Entity\Profile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom',
                'constraints' => [
                    new Regex([
                        'message' => 'Le nom ne doit contenir que des lettres',
                        'pattern' => '/^[a-zA-Z\s]*$/',
                    ])
                ]
            ])
            ->add('firstName', null, [
                'label' => 'Prénom',
                'constraints' => [
                    new Regex([
                        'message' => 'Le nom ne doit contenir que des lettres',
                        'pattern' => '/^[a-zA-Z\s]*$/',
                    ])
                ]
            ])
            ->add('dateDeNaissance', null, [
                'label' => 'Ta date de naissance',
            ])
            ->add('photoFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Effacer',
                'download_label' => 'Télécharger',
                'download_uri' => true,
                'image_uri' => true,
                'asset_helper' => true,
                'label' => 'Photo de profil'
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
        ]);
    }
}
