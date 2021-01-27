<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModeController extends AbstractController
{
    /**
     * @Route("/mode", name="mode")
     */
    public function index(): Response
    {
        return $this->render('mode/index.html.twig', [
            'title' => 'Mode Product',
            'name' => 'Coton',
            'price' => '15e',
            'origin' => 'Egypte'
        ]);
    }
     /**
     * @Route("/mode/15", name="mode_detail")
     */

    public function show(){
        return $this->render('mode/detail.html.twig');
    }
}
