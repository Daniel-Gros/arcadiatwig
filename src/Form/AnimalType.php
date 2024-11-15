<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Habitat;
use App\Entity\User;
use Doctrine\DBAL\Types\BlobType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstName', null, [
            'label' => 'Prénom de l\'animal',
        ])
        ->add('breed', null, [
            'label' => 'Espèce',
        ])
        ->add('diet', null, [
            'label' => 'Régime alimentaire',
        ])
        ->add('user_id', EntityType::class, [
            'class' => User::class,
            'choice_label' => 'email',
            'label' => 'Responsable de l\'animal',
            'placeholder' => 'Sélectionnez un personnel',
            'multiple' => true,
            'expanded' => true,
        ])
        ->add('habitat', EntityType::class, [
            'class' => Habitat::class,
            'choice_label' => 'name',
            'label' => 'Habitat',
            'placeholder' => 'Sélectionnez un habitat',
        ])
        ->add('description', TextareaType::class, [
            'label' => 'Description',
        ])
        ->add('imageFile', FileType::class, [
            'label' => 'Image (JPG, PNG, WEBP)',
            'mapped' => false,
            'required' => false,
        ]);
    
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}

