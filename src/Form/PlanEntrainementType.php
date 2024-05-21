<?php

namespace App\Form;

use App\Entity\PlanEntrainement;
use App\Entity\Profile;
use App\Entity\ProfileCoach;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanEntrainementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('duree')
            ->add('objectif')
            ->add('type')
            ->add('niveau')
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
            'data_class' => PlanEntrainement::class,
        ]);
    }
}
