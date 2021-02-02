<?php

namespace App\Controller;

use App\Entity\BlogCategory;
use App\Form\BlogCategoryType;
use App\Repository\BlogCategoryRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class BlogCategoryController extends AbstractController
{
    /**
     * @Route("/admin/blogCategory/create",name="blogCategory_create")
     */
    public function create(Request $request, EntityManagerInterface $em, SluggerInterface $slugger)
    {
        $blogCategory = new BlogCategory;

        $form = $this->createForm(BlogCategoryType::class, $blogCategory);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blogCategory->setSlug(strtolower($slugger->slug($blogCategory->getName())));
            $em->persist($blogCategory);
            $em->flush();

            return $this->redirectToRoute('blog');
        }

        $formView = $form->createView();

        return $this->render('blog_category/create.html.twig', [
            'formView' => $formView
        ]);
    }

    /**
     * @Route("/admin/blogCategory/{id}/edit",name="blogCategory_edit")
     */
    public function edit($id, BlogCategoryRepository $blogCategoryRepository, Request $request, EntityManagerInterface $em)
    {
        $blogCategory = $blogCategoryRepository->find($id);

        $form = $this->createForm(BlogCategoryType::class, $blogCategory);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($blogCategory);
            $em->flush();

            return $this->redirectToRoute('blog');
        }

        $formView = $form->createView();

        return $this->render('blog_category/edit.html.twig', [
            'blogCategory' => $blogCategory,
            'formView' => $formView
        ]);
    }
}
