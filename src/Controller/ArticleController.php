<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\BlogCategoryRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("blog/{slug}", name="article_blogCategory")
     */
    public function blogCategory($slug, BlogCategoryRepository $blogCategoryRepository): Response
    {
        $blogCategory = $blogCategoryRepository->findOneBy([
            'slug' => $slug
        ]);

        if (!$blogCategory) {
            throw $this->createNotFoundException("La catégorie demandée n'existe pas !");
        }

        return $this->render('article/blogCategory.html.twig', [
            'slug' => $slug,
            'blogCategory' => $blogCategory
        ]);
    }

    /**
     * @Route("blog/{blogCategory_slug}/{slug}", name="article_show")
     */
    public function show($slug, ArticleRepository $articleRepository)
    {
        $article = $articleRepository->findOneBy([
            'slug' => $slug
        ]);

        if (!$articleRepository) {
            throw $this->createNotFoundException("L'article demandée n'existe pas !");
        }

        return $this->render('article/show.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * @Route("/admin/article/create", name="article_create")
     */
    public function create(FormFactoryInterface $factory, BlogCategoryRepository $blogCategoryRepository)
    {
        $builder = $factory->createBuilder();

        $builder->add('title', TextType::class, [
            'label' => 'Titre de l\'article',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Quel est le titre de votre  de l\'article?'
            ]
        ])
            ->add('resume', TextareaType::class, [
                'label' => 'Description courte  de l\'article',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'De quoi parle l\'article en bref?'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu complet de l\'article',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Ecrivez le contenu complet de l\'article en incluant les balises html.'
                ]
            ])
            ->add('image', TextType::class, [
                'label' => 'Image principale de l\'article',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'URL de l\'image'
                ]
            ])
            ->add('date');

        $options = [];

        foreach ($blogCategoryRepository->findAll() as $blogCategory) {
            $options[$blogCategory->getName()] = $blogCategory->getId();
        }

        $builder->add('blogCategory', ChoiceType::class, [
            'label' => 'Catégorie de l\'article',
            'attr' => [
                'class' => 'form-control'
            ],
            'placeholder' => '-- Choisir une catégorie --',
            'choices' => $options
        ]);

        $form = $builder->getForm();

        $formView = $form->createView();

        return $this->render('article/create.html.twig', [
            'formView' => $formView
        ]);
    }
}
