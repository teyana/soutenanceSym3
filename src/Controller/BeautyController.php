<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BeautyController extends AbstractController
{
    /**
     * @Route("/beauty", name="beauty")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Product::class);

        $products = $repo->findByCategory(24);



        return $this->render('beauty/index.html.twig', [
            'title' => 'Beauty Product',
            'name' => 'Beurre de Coco',
            'price' => '5e',
            'origin' => 'Abidjan',
            'products' => $products

        ]);
    }
    /**
     * @Route("/beauty/{id}", name="beauty_detail")
     */

    public function show($id)
    {

        $repo = $this->getDoctrine()->getRepository(Product::class);

        $product = $repo->find($id);

        return $this->render('beauty/detail.html.twig', [
            'title' => 'Beauty Product',
            'product' => $product

        ]);
    }
}
