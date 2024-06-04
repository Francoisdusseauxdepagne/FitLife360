<?php
namespace App\Form;

use App\Entity\Profile;
use App\Entity\Messenger;
use App\Entity\ProfileCoach;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessengerType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, ['label' => 'Objet du message'])
            ->add('content', null, ['label' => 'Message'])
        ;

        // Écouteur d'événements pour ajouter dynamiquement le champ approprié
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $form = $event->getForm();
            $user = $this->security->getUser();

            if ($user && $user->getProfile()) {
                $form->add('idProfileCoach', EntityType::class, [
                    'class' => ProfileCoach::class,
                    'choice_label' => 'firstName',
                    'label' => 'coach',
                ]);
            } elseif ($user && $user->getProfileCoach()) {
                $form->add('idProfile', EntityType::class, [
                    'class' => Profile::class,
                    'choice_label' => 'firstName',
                    'label' => 'Athlète',
                ]);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Messenger::class,
        ]);
    }
}
