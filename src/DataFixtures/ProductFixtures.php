<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
    //     for ($i=1; $i <=9; $i++){
    //         $product = new Product();
    //         $product->setName ("Product Name n° $i")
    //                 ->setPrice("16")
    //                 ->setOrigin("Panama")
    //                 ->setDescription("<Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet sapiente enim illum accusantium reprehenderit? Ipsum eum, aliquam voluptatem voluptatum quos nostrum, non maxime maiores pariatur officiis consequatur, quia quidem laboriosam! lorem Lorem, ipsum dolor sit amet consectetur ")
    //                 ->setQuantity("45")
    //                 ->setCategory("huile" )
    //                 ->setImage("https://placehold.it/600x500")
    //                 ->setCreateAt(new\DateTime());
    //         $manager->persist($product);
    //     }

        $manager->flush();
     }
}
