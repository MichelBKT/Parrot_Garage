<?php

namespace App\Form;

use App\Entity\Avisclient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class EditavisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('libelle', TextareaType::class, [
            'label' => 'Commentaire',
            'attr' => ['class' => 'p-3'],
        ])
        ->add('note', ChoiceType::class, [
            'choices' => [
                '1/5' => 1,
                '2/5' => 2,
                '3/5' => 3,
                '4/5' => 4,
                '5/5' => 5,
            ],
            'mapped' => true,
            'expanded' => true,
            'label' => 'Note',
            'placeholder' => 'Choisir une note',
        ])
        ->add('auteur', TextType::class, [
            'label' => 'Pseudo',
            'attr' => ['class' => "form-control-md"],
        ])
        ->add('actif', CheckboxType:: class, [
            'label' => 'Mettre en ligne',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avisclient::class,
        ]);
    }
}
