<?php

namespace App\Form;

use App\Entity\ContactCoach;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactCoachType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('objet', TextType::class, [
                'label' => 'Objet',
                'attr' => ['class' => 'form-control mb-3'],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Message',
                'attr' => ['class' => 'form-control mb-3', 'rows' => 5],
            ]);

            if (!is_object($options['data']->getIdProfile())) {
                $builder
                    ->add('name', null, ['label' => 'Nom'])
                    ->add('firstName', null, ['label' => 'Prénom'])
                    ->add('email', null, ['label' => 'Email']);
            }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactCoach::class,
        ]);
    }
}
