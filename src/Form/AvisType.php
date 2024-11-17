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
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('message', null, ["label" => "Votre message:"])
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
