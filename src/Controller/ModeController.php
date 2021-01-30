<?php

namespace App\Controller;
use App\Entity\Category;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModeController extends AbstractController
{
    /**
     * @Route("/mode", name="mode")
     */

     //FONCTION de recupération des articles avec la clé secondaire "category" dans la base de données 
    public function index(): Response
    {
        
        $repo =$this -> getDoctrine()->getRepository(Product::class);
        
        $products = $repo->findByCategory(10);
       


        return $this->render('mode/index.html.twig', [
            'title' => 'Mode Product',
            'name' => 'Coton',
            'price' => '15e',
            'origin' => 'Egypte',
            'products' => $products
        
        ]);
    }
     /**
     * @Route("/mode/{id}", name="mode_detail")
     */
        // FONCTION de recupération d'une fiche détail d'article après avoir cliqué dessus. 
    public function show($id){
        
        $repo = $this -> getDoctrine()->getRepository(Product::class);

        $product = $repo->find($id);

        return $this->render('mode/detail.html.twig',[
            'product' => $product,
            'title' => 'Mode Product',
        ]);
    }
}
