<?php

namespace App\Form;

use App\Entity\Spectacle;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpectacleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('villes', EntityType::class, [
                'class'=>Ville::class,
                'choice_label'=>'nom',
                'required' => true,
                'multiple'  => true,
            ])
            ->add('placeDispo')
            ->add('date')
            ->add('tarifEnfantSemaine')
            ->add('tarifEnfantWE')
            ->add('tarifAdultSemaine')
            ->add('tarifAdultWE')
            ->add('content')
            ->add('image', FileType::class, [
                'data_class'=> null,
                'label' => 'Image (jpg, png)',
                'required' => true,
                'mapped' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Spectacle::class,
        ]);
    }
}
