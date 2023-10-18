<?php

namespace App\Controller\Admin;

use App\Entity\Entretien;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntretienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, options:[
                'label' => 'Libellé',
                'label_attr' => ['class' => 'text-white'],
            ])
            ->add('user',EntityType::class, options:[
                'label' => 'Nom de l\'utilisateur',
                'label_attr' => ['class' => 'text-white'],
                'class' => User::class,
                'choice_label' => 'nom',
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entretien::class,
        ]);
    }
}
