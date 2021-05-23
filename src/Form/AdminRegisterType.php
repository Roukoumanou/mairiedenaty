<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class AdminRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Votre Nom'
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Votre Prénom'
            ])
            ->add('email', EmailType::class, [
                'label' => "Votre E-Mail"
            ])
            ->add('country', CountryType::class, [
                'label' => 'Votre Pays De Résidence'
            ])
            ->add('password', PasswordType::class, [
                'label' => "Mot de passe",
                'attr' => [
                    'placeholder' => "*********"
                ]
            ])
            ->add('confirmPass', PasswordType::class, [
                'label' => "Répeter le mot de passe",
                'attr' => [
                    'placeholder' => "********"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
