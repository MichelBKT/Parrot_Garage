<?php

namespace App\Controller\Admin_User;

use App\Entity\Annonce;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AdvertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class)
            ->add('prix', IntegerType::class)
            ->add('ct_ok', CheckboxType::class, options:[
                'label' => 'Contrôle technique ok?',
                'required' => false,
            ])
            ->add('kilometrage', IntegerType::class, options:[
                'label' => 'Kilométrage'
            ])
            ->add('Boite_vitesse_manuelle', CheckboxType::class,options:[
                'required' => false,
            ])
            ->add('nombre_de_portes_5', CheckboxType::class, options:[
                'label' => 'Nombre de portes : 5 ?',
                'required' => false,
            ])
            ->add('puissance_fiscale', IntegerType::class, options:[
                'label' => 'Puissance fiscale (cv)'
            ])
            ->add('emission_CO2', IntegerType::class, options:[
                'label' => 'Emission de CO2 par km (en grammes)'
            ])
            ->add('photo', FileType::class, options:[
                'label' => false,
                'required' => false,
                'multiple' => true,
                'mapped' => false
            ])
        
            ->add('created_at', DateTimeType::class, options:[
                'data' => new \DateTime('now'),
                'disabled' => true,
                'label' => 'Date et heure de création'
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'label' => 'Utilisateur',
                'choice_label' => 'nom',
                'placeholder' => 'Choisir un nom'
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
