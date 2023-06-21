<?php

namespace App\Controller\Admin_User;

use App\Entity\Caracteristique;
use App\Entity\Voiture;
use App\Entity\VoitureCaracteristique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LinkCarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('voiture', EntityType::class, [
                'class' => Voiture::class,
                'choice_label' => function (Voiture $voiture){
                    return $voiture->getId(). ' ' .$voiture->getMarque(). ' ' .$voiture->getModele(). ' ' .$voiture->getEnergie(). ' ' .$voiture->getKm(). ' km';
                }])
            ->add('caracteristique', EntityType::class, [
                'class' => Caracteristique::class,
                'choice_label' => function (Caracteristique $caracteristique){
                    return 'Id: ' .$caracteristique->getId(). ' ' .$caracteristique->getPuissanceFisc(). 'cv ' .$caracteristique->getPuissanceDin(). ' ch';
                }])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VoitureCaracteristique::class,
        ]);
    }
}
