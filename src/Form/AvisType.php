<?php

namespace App\Form;

use App\Entity\Avis;
use App\Entity\User;
use PhpParser\Node\Stmt\Label;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', null, [
                "label" => "Votre pseudonyme:",
                'attr' => [
                    'placeholder' => 'Pseudo'
                ]
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
            ->add('note', ChoiceType::class, [
                'label' => 'Votre note:',
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
            ])
            ->add('validation', HiddenType::class, [
                'data' => false,
            ])
            ->add('user_id', HiddenType::class, [
                'data' => $options['user_id'] ?? null,
            ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,

        ]);
    }
}
