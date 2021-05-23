<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => "Votre E-Mail",
                'attr' => [
                    'placeholder' => 'Votre E-mail'
                ]
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Votre Nom',
                'attr' => [
                    'placeholder' => 'Votre Nom'
                ]
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Votre Prénom',
                'attr' => [
                    'placeholder' => 'Votre PréNom'
                ]
            ])
            ->add('country', CountryType::class, [
                'label' => 'Votre Pays De Résidence'
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'J\'accepte',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions.',
                    ]),
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => "Mot de passe",
                'attr' => [
                    'placeholder' => "Mot de passe"
                ]
            ])
            ->add('confirmPass', PasswordType::class, [
                'label' => "Répeter le mot de passe",
                'attr' => [
                    'placeholder' => "Confirmez le mot de pass"
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
