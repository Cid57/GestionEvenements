<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\Participant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('evenement', EntityType::class, [
                'class' => Evenement::class,
                'choice_label' => function (Evenement $evenement) {
                    return sprintf('%s - %s - %s', $evenement->getEvenement(), $evenement->getDate()->format('d-m-Y'), $evenement->getDate()->format('H:i'));
                },
                'label' => 'Événement',
                'attr' => ['class' => 'form-control']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
