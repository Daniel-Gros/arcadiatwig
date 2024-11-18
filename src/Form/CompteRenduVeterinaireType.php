<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\CompteRenduVeterinaire;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompteRenduVeterinaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', null, [
                'widget' => 'single_text',
                'data' => new \DateTime(), 
            ])
            ->add('user_id', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'label' => 'Vétérinaire',
                'placeholder' => 'Sélectionnez un vétérinaire',
            ])
            ->add('message')
            ->add('animal_id', EntityType::class, [
                'class' => Animal::class,
                'choice_label' => 'firstName',
                'label' => 'Nom de l\'animal',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CompteRenduVeterinaire::class,
        ]);
    }
}
