<?php

namespace App\Form;

use App\Entity\Resiliation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ResiliationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('objet', ChoiceType::class, [
                'label' => 'Objet',
                'choices' => [
                    '' => '',
                    'Je souhaite changer de formule' => 'Je souhaite changer de formule',
                    'Je n\'ai plus besoin de vos services' => 'Je n\'ai plus besoin de vos services',
                    'Je rencontre des difficultés financières' => 'Je rencontre des difficultés financières',
                    'Je rencontre des problèmes techniques récurrents' => 'Je rencontre des problèmes techniques récurrents',
                    'Je suis insatisfait du service client' => 'Je suis insatisfait du service client',
                    'Je n\'ai plus besoin de ce service actuellement' => 'Je n\'ai plus besoin de ce service actuellement',
                    'J\'ai trouvé une meilleure alternative' => 'J\'ai trouvé une meilleure alternative',
                    'Je rencontre des problèmes de facturation' => 'Je rencontre des problèmes de facturation',
                    'Ma situation personnelle a changé' => 'Ma situation personnelle a changé',
                ],
                'attr' => ['id' => 'resiliation_objet'] // Add id attribute for easy selection in JS
            ])
            ->add('content', null, [
                'label' => 'Message de résiliation',
                'attr' => [
                    'id' => 'resiliation_content',
                    'readonly' => true, // Rend le champ non modifiable
                ]
            ])        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Resiliation::class,
        ]);
    }
}
