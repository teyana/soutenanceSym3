<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\BlogCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de l\'article',
                'attr' => [
                    'placeholder' => 'Quel est le titre de votre  de l\'article?'
                ]
            ])
            ->add('resume', TextareaType::class, [
                'label' => 'Description courte  de l\'article',
                'attr' => [
                    'placeholder' => 'De quoi parle l\'article en bref?'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu complet de l\'article',
                'attr' => [
                    'placeholder' => 'Ecrivez le contenu complet de l\'article en incluant les balises html.'
                ]
            ])
            ->add('image', UrlType::class, [
                'label' => 'Image principale de l\'article',
                'attr' => [
                    'placeholder' => 'URL de l\'image'
                ]
            ])
            ->add('blogCategory', EntityType::class, [
                'label' => 'Catégorie de l\'article',
                'placeholder' => '-- Choisir une catégorie --',
                'class' => BlogCategory::class,
                'choice_label' => 'name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
