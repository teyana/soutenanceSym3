<?php

namespace App\Controller;

use App\Repository\BlogCategoryRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogCategoryController extends AbstractController
{
    /**
     * @Route("/admin/blogCategory/create",name="blogCategory_create")
     */
    public function create()
    {
        return $this->render('blog_category/create.html.twig');
    }

    /**
     * @Route("/admin/blogCategory/{id}/edit",name="blogCategory_edit")
     */
    public function edit($id, BlogCategoryRepository $blogCategoryRepository)
    {
        $blogCategory = $blogCategoryRepository->find($id);

        return $this->render('blog_category/edit.html.twig', [
            'blogCategory' => $blogCategory
        ]);
    }
}
