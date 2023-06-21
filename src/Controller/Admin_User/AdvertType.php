<?php

namespace App\Controller\Admin_User;

use App\Entity\Annonce;
use App\Entity\User;
use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AdvertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class)
            ->add('prix', IntegerType::class)
            ->add('created_at', DateTimeType::class, options:[
                'data' => new \DateTime('now'),
                'disabled' => true,
                'label' => 'Date et heure de création'
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'nom'
            ])
            ->add('voiture', EntityType::class, [
                'class' => Voiture::class,
                'choice_label' => function (Voiture $voiture){
                    return $voiture->getId(). ' ' .$voiture->getMarque(). ' ' .$voiture->getModele(). ' ' .$voiture->getEnergie(). ' ' .$voiture->getKm(). ' km';
                }

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
