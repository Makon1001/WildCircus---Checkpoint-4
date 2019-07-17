<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Spectacle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('school')
            ->add('nomEtablissement')
            ->add('nbEnfant')
            ->add('nbAdulte')
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('spectacle', EntityType::class, [
                'class'=>Spectacle::class,
                'choice_label'=>'name',
                'required' => true,
                'multiple'  => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
