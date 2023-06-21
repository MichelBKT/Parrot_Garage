<?php

namespace App\Controller\Admin_User;

use App\Entity\Couleur;
use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque', TextType::class)
            ->add('modele', TextType::class)
            ->add('annee', DateType::class,[
                'format' => 'dd MM yyyy',
                'placeholder' => [
                    'day' => 'Jour',
                    'month' => 'Mois',
                    'year' => 'Année'
,                ],
                'years' => range(date('Y'), date('Y') - (date('Y')-1990)),
                'label' => 'Date de mise en circulation'
            ])
            ->add('energie', TextType::class)
            ->add('ct_ok', options:[
                'label' => 'Contrôle Technique OK'
            ])
            ->add('photo', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false,

            ])
            ->add('km', IntegerType::class, options: [
                'label' => 'Kilométrage'
            ])
            ->add('couleur', EntityType::class, [
                'class' => Couleur::class,
                'choice_label' => 'libelle'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
