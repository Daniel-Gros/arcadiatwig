<?php 

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType as TypeDateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompteRenduFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('animal', TextType::class, [
                'required' => false,
                'label' => 'Filtrer par Animal',
                'attr' => ['placeholder' => 'Nom de l\'animal'],
            ])
            ->add('date', TypeDateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'label' => 'Filtrer par Date',
                'attr' => ['placeholder' => 'jour/mois/année',
                'class' => 'd-none'],
            ])
            ->add('submit', SubmitType::class, ['label' => 'Filtrer'])
            ->add('reset', SubmitType::class, ['label' => 'Afficher tous les comptes rendus']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
