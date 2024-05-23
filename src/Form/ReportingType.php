<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\Profile;
use App\Entity\Reporting;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('comment')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            // ->add('idProfile', EntityType::class, [
            //     'class' => Profile::class,
            //     'choice_label' => 'id',
            // ])
            // ->add('idComment', EntityType::class, [
            //     'class' => Comment::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reporting::class,
        ]);
    }
}
