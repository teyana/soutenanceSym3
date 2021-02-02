<?php

namespace App\DataFixtures;

use App\Entity\Category;
use DateTime;
use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $mode = new Category();
        $mode->setLabel("mode");

        $food = new Category();
        $food->setLabel("food");

        $beauty = new Category();
        $beauty->setLabel("beauty");

        $manager->persist($food);
        $manager->persist($mode);
        $manager->persist($beauty);

        $categories = [$mode, $food,$beauty];

        for ($i=1; $i <= 4; $i++){
            $category= $categories[mt_rand(0, count($categories) -1)];
            $product = new Product();
            $product->setName("Carapate n° ".$i)
                    ->setPrice(16)
                    ->setOrigin("Panama")
                    ->setDescription("
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet sapiente enim illum accusantium reprehenderit? Ipsum eum, aliquam voluptatem voluptatum quos nostrum, non maxime maiores pariatur officiis consequatur, quia quidem laboriosam! lorem Lorem, ipsum dolor sit amet consectetur</p> ")
                    ->setQuantity(45)
                    ->setCategory($category)
                    ->setImage("https://placehold.it/600x500")
                    ->setCreatedAt( new \DateTime() );

            $manager->persist($product);
        }

        $manager->flush();
     }
}
