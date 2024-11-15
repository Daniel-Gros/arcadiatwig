<?php

namespace App\Form;

use App\Entity\Habitat;
use App\Entity\User;
use Doctrine\DBAL\Types\BlobType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HabitatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('user_id', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
                'label' => 'Responsable de l\'habitat',
                'placeholder' => 'Sélectionnez un personnel',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Image (JPG, PNG, WEBP)',
                'mapped' => false,
                'required' => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Habitat::class,
        ]);
    }
}
