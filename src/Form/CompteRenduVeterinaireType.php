<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\CompteRenduVeterinaire;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


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
            ->add('message', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Le message ne peut pas être vide.',
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-Z0-9\s\.,!?-]+$/',
                        'message' => 'Le message ne peut contenir que des lettres, chiffres, espaces et certains caractères spéciaux (. , ! ? -).',
                    ]),
                ],
                'label' => 'Message',
            ])
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
