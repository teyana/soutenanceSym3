<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Service\Cart\CartService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="panier")
     */
    public function index(CartService $cartService)
    {

        return $this->render('cart/index.html.twig', [
            'items'=> $cartService->getFullCart(),
            'total'=> $cartService->getTotal()
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="panier_new", methods={"GET"})
     * 
     *
     */
    public function add($id, CartService $cartService){
        $cartService->add($id);

        return $this->redirectToRoute('panier');
    // afficher variable de session -> avec tous les produit ajoutés 
    // table temporaire dans la BDD pour le panier
    }

    /**
     * @Route("/cart/remove{id}", name="panier_remove", methods={"GET"})
     *
     */
    public function remove($id, CartService $cartService){
        $cartService->remove($id);

        return $this->redirectToRoute('panier');
    }
}
