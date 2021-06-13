<?php

namespace App\Form;

use App\Entity\Services;
use App\Entity\Prestations;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PrestationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Type de Prèstation',
                'attr' => [
                    'placeholder' => 'Acte de Naissance'
                ]
            ])
            ->add('cout', IntegerType::class, [
                'label' => 'Coût'
            ])
            ->add('delai', TextType::class, [
                'label' => 'Délai'
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Cover'
            ])
            ->add('pieces', CKEditorType::class)
            ->add('service', EntityType::class, [
                'expanded' => true,
                'class' => Services::class,
                'choice_label' => 'name'
            ])
            ->add('description', CKEditorType::class)
            ->add('status', CheckboxType::class, [
                'label' => 'Disponible?',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prestations::class,
        ]);
    }
}
