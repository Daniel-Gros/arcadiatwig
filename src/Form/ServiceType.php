<?php

namespace App\Form;

use App\Entity\Service;
use App\Entity\User;
use Doctrine\DBAL\Types\BlobType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('user_id', EntityType::class, [
                'class' => User::class,
                'choice_label' => function (User $user) {
                    return $user->getId() . ' - ' . $user->getEmail();
                },
                'label' => 'Responsable du service',
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
            'data_class' => Service::class,
        ]);
    }
}
