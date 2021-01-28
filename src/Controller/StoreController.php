<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StoreController extends AbstractController
{
    /**
     * @Route("/store", name="store")
     */
    public function index(): Response
    {
        return $this->render('store/index.html.twig', [
            'controller_name' => 'StoreController',
            'title' => 'Store',
            'name' => 'Coton',
            'price' => '15e',
            'origin' => 'Egypte'
        ]);
    }
}
