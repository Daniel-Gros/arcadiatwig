<?php

namespace App\Form;

use App\Entity\Nourriture;
use App\Entity\TypeNourriture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NourritureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom de l\'aliment',
            ])
            ->add('type', EntityType::class, [
                'class' => TypeNourriture::class,
                'choice_label' => 'name',
                'label' => 'Catégorie d\'Aliment',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Nourriture::class,
        ]);
    }
}
