<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\UserRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    ////////////FONCTION QUI RENVOIE A L'ESPACE ADMINISTRATEUR//////////
    /**
     * @Route("/admin", name="dashboard")
     */
    public function dashboard(ProductRepository $productRepository, UserRepository $userRepository): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'products' => $productRepository->findByMaxValue(),
            'users' => $userRepository->findAll(),
            'lastproducts' => $productRepository->findByLaterDate()
        ]);
    }
    ////////////FONCTION QUI RENVOIE A LA LISTE COMPLETE DES PRODUITS
    /**
     * @Route("/admin/product", name="product_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository): Response
    {

        return $this->render('admin/product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    ////////////FONCTION QUI RENVOIE AU FORMULAIRE DE CREATION D'UN nOUVEAU PRODUIT 
    /**
     * @Route("/admin/product/new", name="product_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $product = new Product();;
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('admin/product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/product/{id}", name="product_show", methods={"GET"})
     */
    public function show(Product $product): Response
    {
        return $this->render('admin/product/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/admin/product/{id}/edit", name="product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('admin/product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/product/{id}", name="product_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_index');
    }


    /*--------------------------------------------------------------
                        ADMIN USER !!!
--------------------------------------------------------------*/

    /*--------------------------------------------------------------
    VOIR TOUS LES USER
--------------------------------------------------------------*/

    /**
     * @Route("/admin/user", name="user_index", methods={"GET"})
     */
    public function indexUser(UserRepository $userRepository): Response
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /*--------------------------------------------------------------
    AJOUTER UN USER (NEW)
--------------------------------------------------------------*/

    /**
     * @Route("/admin/user/new", name="user_new", methods={"GET","POST"})
     */
    public function new_user(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('admin/user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /*--------------------------------------------------------------
    VOIR LE "PROFIL" D'UN UTILISATEUR (SHOW)
--------------------------------------------------------------*/

    /**
     * @Route("/admin/user/{id}", name="user_show", methods={"GET"})
     */
    public function show_user(User $user): Response
    {
        return $this->render('admin/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /*--------------------------------------------------------------
    MODIFIER LE "PROFIL" D'UN UTILISATEUR (EDIT)
--------------------------------------------------------------*/

    /**
     * @Route("/admin/user/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit_user(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /*--------------------------------------------------------------
    SUPPRIMER LE "PROFIL" D'UN UTILISATEUR (DELETE)
--------------------------------------------------------------*/

    /**
     * @Route("/admin/user/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete_user(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
