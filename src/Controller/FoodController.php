<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FoodController extends AbstractController
{
    /**
     * @Route("/food", name="food")
     */
    public function index(): Response
    {
        return $this->render('food/index.html.twig', [
            'title' => 'Food product',
            'name' => 'Noix de Muscade',
            'price' => '4e',
            'origin' => 'Mali'
        ]);
    }
     /**
     * @Route("/food/15", name="food_detail")
     */

    public function show(){
        return $this->render('food/detail.html.twig');
    }
}
