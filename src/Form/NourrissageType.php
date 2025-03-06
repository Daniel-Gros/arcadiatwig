<?php

namespace App\Form;

use App\Entity\Nourrissage;
use App\Entity\Animal;
use App\Entity\Nourriture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NourrissageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datetime', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date et Heure du nourrissage',
                'required' => true,
                'data' => new \DateTime(),
            ])
            ->add('quantity', IntegerType::class, [
                'label' => 'Quantité de nourriture (en grammes)',
                'required' => true,
            ])
            ->add('animal', EntityType::class, [
                'class' => Animal::class,
                'choice_label' => 'firstName',
                'label' => 'Sélectionner un animal',
                'required' => true,
            ])
            ->add('nourriture', EntityType::class, [
                'class' => Nourriture::class,
                'choice_label' => 'name', 
                'label' => 'Sélectionner une nourriture',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Nourrissage::class,
        ]);
    }
}
