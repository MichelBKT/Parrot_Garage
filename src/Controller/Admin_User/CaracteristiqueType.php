<?php

namespace App\Controller\Admin_User;

use App\Entity\Caracteristique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CaracteristiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('boite_vitesse_manuelle')
            ->add('nb_portes_5')
            ->add('puissance_fisc')
            ->add('puissance_din')
            ->add('co2');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Caracteristique::class
        ]);
    }
}
