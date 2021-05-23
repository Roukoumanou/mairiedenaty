<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\Categories;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'placeholder' => 'Un titre ici'
                ]
            ])
            ->add('Content', CKEditorType::class)
            ->add('publishedAt', DateType::class, [
                'label' => 'Date De publication',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('status', ChoiceType::class, [
                'expanded' => true,
                'label' => "Status",
                'choices' => [
                    'Publié' => 'public',
                    'Archivé' => 'archived',
                    'Brouillon' => 'brouillon'
                ]
            ])
            ->add('cover', TextType::class, [
                'label' => "Cover Route",
                'attr' => [
                    'placeholder' => "La route de l'image ici"
                ]
            ])
            ->add('category', EntityType::class, [
                'expanded' => true,
                'class' => Categories::class,
                'choice_label' => 'name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
