<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    /**
     * Permet d'avoir la configuration d'un champ
     *
     * @param [type] $label
     * @param [type] $placeholder
     * @return array
     */
    private function getConfiguration($label, $placeholder){
        return[
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ];

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, $this->getConfiguration("Prénom", "Votre prénom"))
            ->add('lastName', TextType::class, $this->getConfiguration("Nom", "Votre nom"))
            ->add('phone', NumberType::class, $this->getConfiguration("Numéro de téléphone", "Votre numéro de téléphone"))
            ->add('mail', EmailType::class, $this->getConfiguration("Adresse mail", "Votre adresse mail"))
            ->add('message', TextareaType::class, $this->getConfiguration("Message", "Ecrivez-nous votre message ici"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
