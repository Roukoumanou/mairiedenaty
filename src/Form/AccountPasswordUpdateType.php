<?php

namespace App\Form;

use App\Entity\PasswordEdit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class AccountPasswordUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', PasswordType::class, [
                'label' => 'Ancien Mot De Passe',
                'attr' => [
                    'placeholder' => 'µµµµµµµµ'
                ]
            ])
            ->add('newPassword', PasswordType::class, [
                'label' => 'Nouveau Mot De Passe',
                'attr' => [
                    'placeholder' => '********'
                ]
            ])
            ->add('confirmeNewPassword', PasswordType::class, [
                'label' => 'Répeter le Nouveau Mot De Passe',
                'attr' => [
                    'placeholder' => '********'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PasswordEdit::class,
        ]);
    }
}
