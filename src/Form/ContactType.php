<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('objet', ChoiceType::class, [
            'label' => 'Objet',
            'choices' => [
                '' => '',
                'Je souhaite changer de coach' => 'Je souhaite changer de coach',
                'J\'ai choisis mon coach' => 'J\ai choisis mon coach',
                'Autre' => 'Autre',
            ],
        ])
            ->add('text', null, ['label' => 'Message']);

        // Ajouter les champs name, firstName et email uniquement si aucun utilisateur n'est connecté
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
            'data_class' => Contact::class,
        ]);
    }
}
