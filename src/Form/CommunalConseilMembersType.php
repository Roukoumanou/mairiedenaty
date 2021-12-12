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
                    'Maire' => CommunalConseilMembers::MAIRE,
                    'Adjoints Au Maire' => CommunalConseilMembers::ADJOINTS_AU_MAIRE,
                    'C.A' => CommunalConseilMembers::C_A,
                    'Pdt CAEF' => CommunalConseilMembers::PDT_CAEF,
                    'Pdte CASC' => CommunalConseilMembers::PDTE_CASC,
                    'Pdt Com.Plaintes' => CommunalConseilMembers::PDT_COM_PLAINTES,
                    'Pdt CADE' => CommunalConseilMembers::PDT_CADE,
                    'Conseiller Communal' => CommunalConseilMembers::CONSEILLERS_COMMUNAL
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
