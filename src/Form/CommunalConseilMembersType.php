<?php

namespace App\Form;

use App\Entity\CommunalConseilMembers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommunalConseilMembersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Titre'
                ]
            ])
            ->add('fullName', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom et Prénom'
                ]
            ])
            ->add('poste', ChoiceType::class, [
                'choices' => [
                    'Maire' => 'maire',
                    'Adjoints Au Maire' => 'adjoints_au_maire',
                    'C.As' => 'c.as',
                    'Pdt CAEF' => 'caef',
                    'Pdte CASC' => 'casc',
                    'Pdt Com.Plaintes' => 'plaintes',
                    'Pdt CADE' => 'cade',
                    'Conseiller Communal' => 'c.cs'
                ]
            ])
            ->add('mandature', TextType::class, [
                'attr' => [
                    'placeholder' => 'Mandature'
                ]
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Cover',
                'required' => false
            ])
            ->add('bio', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Biographie'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommunalConseilMembers::class,
        ]);
    }
}
