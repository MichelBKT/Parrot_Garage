<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, options:[
                'label' => 'Libellé',
                'label_attr' => ['class' => 'text-white'],
            ])
            ->add('user', EntityType::class, options:[
                'class' => User::class,
                'label' => 'Nom de l\'utilisateur',
                'label_attr' => ['class' => 'text-white'],
                'choice_label' => 'nom',
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
