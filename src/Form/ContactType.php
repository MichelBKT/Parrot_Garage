<?php

namespace App\Form;


use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    #[Route('/form', name: 'app_form')]
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', ChoiceType::class, [
                'choices' => [
                    'M.' => 'M.',
                    'Mme' => 'Mme',
                ],
                'label' => false,
                'mapped' => true,
                'expanded' => true,
                'attr' => [ 'class' => 'text-light' ],
            ])
            ->add('nom', TextType::class, [
                'label_attr' => [ 'class' => 'text-light'],
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'label_attr' => [ 'class' => 'text-light'],
            ])
            ->add('email', EmailType::class, [
                'label_attr' => [ 'class' => 'text-light'],
            ])
            ->add('objet', TextType::class, [
                'label_attr' => [ 'class' => 'text-light'],
            ])  
            ->add('sujet', TextareaType::class, [
                'label_attr' => [ 'class' => 'text-light'],
                'attr' => [ 'class' => 'form-control-lg']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
