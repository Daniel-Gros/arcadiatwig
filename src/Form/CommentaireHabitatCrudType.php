<?php

namespace App\Form;

use App\Entity\CommentaireHabitat;
use App\Entity\Habitat;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class CommentaireHabitat1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('message', TextType::class, [
            'constraints' => [
                new Assert\NotBlank([
                    'message' => 'Le message ne peut pas être vide.',
                ]),
            ],
            'label' => 'Message',
        ])
            ->add('improvement', CheckboxType::class, [
                'label' => 'Amélioration',
                'required' => false,
                'mapped' => true,
            ])
            ->add('habitat_id', EntityType::class, [
                'class' => Habitat::class,
                'choice_label' => 'name',
                'label' => 'Habitat',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CommentaireHabitat::class,
        ]);
    }
}
