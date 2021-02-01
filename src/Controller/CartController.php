<?php

namespace App\Controller;

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
     * @Route("/cart/add/{id}", name="panier_new")
     * 
     *
     */
    public function ad($id, CartService $cartService){
        $cartService->add($id);

        return $this->redirectToRoute('panier');

    }

    /**
     * @Route("/cart/remove{id}", name="panier_remove")
     *
     */
    public function remove($id, CartService $cartService){
        $cartService->remove($id);

        return $this->redirectToRoute('panier');
    }
}
