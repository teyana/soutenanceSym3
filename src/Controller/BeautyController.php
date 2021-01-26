<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BeautyController extends AbstractController
{
    /**
     * @Route("/beauty", name="beauty")
     */
    public function index(): Response
    {
        return $this->render('beauty/index.html.twig', [
            'title' => 'Beauty Product',
            'name' => 'Beurre de Coco',
            'price' => '5e',
            'origin' => 'Abidjan'
            
        ]);
    }
    /**
     * @Route("/beauty/15", name="beauty_detail")
     */

     public function show(){
         return $this->render('beauty/detail.html.twig');
     }
}
