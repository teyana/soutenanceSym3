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
            'controller_name' => 'ModeController',
        ]);
    }
}
