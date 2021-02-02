<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FoodController extends AbstractController
{
    /**
     * @Route("/food", name="food")
     */
    public function index(): Response
    {
        $repo =$this -> getDoctrine()->getRepository(Product::class);
        
        $products = $repo->findByCategory(9);

        return $this->render('food/index.html.twig', [
            'title' => 'Food product',
            'name' => 'Noix de Muscade',
            'price' => '4e',
            'origin' => 'Mali',
            'products' => $products
        ]);
    }
    /**
     * @Route("/food/{id}", name="food_detail")
     */

    public function show($id)
    {

        $repo = $this->getDoctrine()->getRepository(Product::class);

        $product = $repo->find($id);


        return $this->render('food/detail.html.twig', [
            'title' => 'Food Product',
            'product' => $product
            
        ]);
    }
}
