<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\BlogCategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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
    public function create(Request $request, SluggerInterface $slugger, EntityManagerInterface $em)
    {
        $article = new Article;

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted($request)) {
            $article->setSlug(strtolower($slugger->slug($article->getTitle())));

            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_show', [
                'blogCategory_slug' => $article->getBlogCategory()->getSlug(),
                'slug' => $article->getSlug()
            ]);
        }

        $formView = $form->createView();

        return $this->render('article/create.html.twig', [
            'formView' => $formView
        ]);
    }

    /**
     * @Route("/admin/article/{id}/edit", name="article_edit")
     */
    public function edit($id, ArticleRepository $articleRepository, Request $request, EntityManagerInterface $em)
    {
        $article = $articleRepository->find($id);

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted($request)) {
            $em->flush();

            return $this->redirectToRoute('article_show', [
                'blogCategory_slug' => $article->getBlogCategory()->getSlug(),
                'slug' => $article->getSlug()
            ]);
        }

        $formView = $form->createView();

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'formView' => $formView
        ]);
    }
}
