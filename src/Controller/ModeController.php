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
    public function index(): Response
    {
        $repo =$this -> getDoctrine()->getRepository(Product::class);
        
        $products = $repo->findByCategory(2);

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

    public function show($id){
        $repo = $this -> getDoctrine()->getRepository(Product::class);

        $product = $repo->find($id);

        return $this->render('mode/detail.html.twig',[
            'product' => $product,
            'title' => 'Mode Product',
            // 'name' => 'Coton',
            // 'price' => '15e',
            // 'origin' => 'Egypte', 
            // 'description' =>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet sapiente enim illum accusantium reprehenderit? Ipsum eum, aliquam voluptatem voluptatum quos nostrum, non maxime maiores pariatur officiis consequatur, quia quidem laboriosam! lorem Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eaque a repellat nostrum mollitia iste aut corrupti! Maiores quae velit tempora dolorem assumenda, sequi, adipisci fugit vel provident explicabo, autem laborum.', 
            // 'story' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore optio ad enim nemo omnis doloribus reiciendis facere officia corporis, magnam alias expedita quaerat quasi molestias perspiciatis iste provident ipsa hic! Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam nam perspiciatis expedita, harum illo et. Ullam totam quas pariatur, dolorem aliquam, nostrum nesciunt iste voluptatem, optio asperiores veritatis necessitatibus ab. Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate fuga deleniti aut quod magni recusandae facere officiis nam cumque vero temporibus delectus consequatur quas ut velit, quibusdam ullam, consequuntur quos! Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum dolor quasi veritatis hic quam asperiores distinctio quo. Soluta illo reprehenderit enim eius? Illo similique architecto nisi! Accusamus ab esse incidunt.',
        
        ]);
    }
}
