<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompteController extends AbstractController
{
    /**
     * @Route("/compte1", name="compte1")
     */
    public function index(FormFactoryInterface $factory): Response
    {

        $builder = $factory->createBuilder();

        $builder->add('email', EmailType::class, [
                'label' => 'Adresse mail',
                'attr' => ['placeholder' => 'Entrez votre adresse mail']
        ])
            ->add('mot_de_passe', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => ['placeholder' => 'Entrez votre mot de passe']
            ]);

            $form = $builder->getForm();

            $formView = $form->createView();

        return $this->render('compte1/index.html.twig', [
            'formView' => $formView
        ]);
        // return $this->render('compte1/index.html.twig', [
        //     'controller_name' => 'CompteController',
        // ]);
    }

    /**
     * @Route("/compte1/create", name="compte1_create")
     */
    public function create(FormFactoryInterface $factory_1)
    {
        $builder_1 = $factory_1->createBuilder();

        $builder_1->add('nom', TextType::class, [
            'label' => 'Nom',
            'attr' => ['placeholder' => "Entrez votre nom"]
        ])
            ->add('prenom', TextType::class, [
                'label' => 'Entrez votre prénom',
                'attr' => ['placeholder' => 'Entrez votre prénom']
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse mail',
                'attr' => ['placeholder' => 'Entrez votre adresse mail']
            ])
            ->add('adresse', TextareaType::class, [
                'label' => 'Adresse',
                'attr' => ['placeholder' => 'Entrez votre adresse']
            ])
            ->add('code_postale', TextType::class, [
                'label' => 'Code postale',
                'attr' => ['placeholder' => 'Entrez votre code postale']
            ])
            ->add('numero', TelType::class, [
                'label' => 'Entrez votre numéro de téléphone',
                'attr' => ['placeholder' => 'Entrez votre numéro de téléphone']
            ])
            ->add('mot_de_passe', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => ['placeholder' => 'Entrez un mot de passe']
            ]);

            $form_1 = $builder_1->getForm();

            $formView_1 = $form_1->createView();

        return $this->render('compte/create.html.twig', [
            'formView' => $formView_1
        ]);
    }

}
