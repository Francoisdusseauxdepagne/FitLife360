<?php

namespace App\Form;

use App\Entity\Avis;
use App\Entity\Profile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('note', ChoiceType::class, [
                'label' => 'Note',
                'choices' => [
                    '★★★★★' => 5,
                    '★★★★' => 4,
                    '★★★' => 3,
                    '★★' => 2,
                    '★' => 1,
                    '0' => 0
                ]
            ])
            ->add('content', null, [
                'label' => 'Commentaire'                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}
