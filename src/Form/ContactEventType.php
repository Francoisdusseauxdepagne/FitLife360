<?php

namespace App\Form;

use App\Entity\ContactEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextType::class, [
                'label' => 'Message',
                'data' => 'Je souhaite réserver pour cet événement', // Valeur prédéfinie
                'attr' => [
                    'readonly' => true, // Rend le champ en lecture seule (optionnel)
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactEvent::class,
        ]);
    }
}