<?php

namespace App\Controller\Admin;

use App\Entity\Poste;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, options:[
            'label' => 'E-mail'
        ])
        ->add('password', PasswordType::class, options:[
            'label' => 'Mot de passe'
        ])
        ->add('nom', TextType::class)
        ->add('prenom', TextType::class)
        ->add('poste', EntityType::class, [
            'class' => Poste::class,
            'choice_label' => 'libelle'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
