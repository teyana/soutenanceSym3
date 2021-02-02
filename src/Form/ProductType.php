<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,  [
                'label' => 'Le nom du produit',  
                'attr' => [
                    'placeholder' => 'Ecris un truc michel' , 
                    'class' => 'col-4' ]
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix',
                "attr" => [
                    "class" => "col-3"
                ]
            ])
            ->add('origin', TextType::class , [
                'label' => "Pays d'origine"
            ])
            ->add('image', UrlType::class, [
                "label" => "Image d'un produit"
            ])
            ->add('description', TextareaType::class, [
                "label" => "Description détaillé"
            ])
            ->add('quantity', NumberType::class , [
               "label" => "Quantité en stock",
               "attr" => [
                   "class" => "col-3"
               ]
            ])
            ->add('category', EntityType::class, [
                "label" => "Catégorie du produit",
                'class' => Category::class,
                'choice_label' => 'label',
                "attr" => [
                    "class" => "col-3"
                ]
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
