<?php

namespace App\Form;

use App\Entity\PlanAlimentaire;
use App\Entity\Profile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanAlimentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('dateDebut', null, [
                'widget' => 'single_text',
            ])
            ->add('dateFin', null, [
                'widget' => 'single_text',
            ])
            ->add('idProfile', EntityType::class, [
                'class' => Profile::class,
                'choice_label' => function (Profile $profile) {
                    $user = $profile->getIdUser();
                    return $user->getFirstName() . ' ' . $user->getName();
                },
                'label' => 'Client'
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlanAlimentaire::class,
        ]);
    }
}
