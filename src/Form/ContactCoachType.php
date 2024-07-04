<?php

namespace App\Form;

use App\Entity\ContactCoach;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactCoachType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('objet', ChoiceType::class, [
                'label' => 'Objet',
                'choices' => [
                    '' => '',
                    'Je souhaite des informations' => 'Je souhaite des informations',
                    'Je souhaite prendre un rendez-vous' => 'Je souhaite prendre un rendez-vous',
                ],
                'attr' => ['id' => 'contact_coach_objet']
            ])
            ->add('content', null, [
                'label' => 'Message',
                'attr' => [
                    'id' => 'contact_coach_content',
                    'readonly' => true,
                ]            
            ]);

            if (!is_object($options['data']->getIdProfile())) {
                $builder
                    ->add('name', null, ['label' => 'Nom'])
                    ->add('firstName', null, ['label' => 'Prénom'])
                    ->add('email', null, ['label' => 'Email']);
;
            }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactCoach::class,
        ]);
    }
}
