<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use PhpParser\Node\Stmt\Label;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null,
                ['required' => true,
                'label' => 'Votre nom',
                ])
            ->add('email', EmailType::class,
                ['required' => true,
                'label' => 'Votre email',
                ])
                ->add('message', TextType::class, [
                    'required' => true,
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'required_role' => 'ROLE_EMPLOYEE',
        ]);
    }
}
