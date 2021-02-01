<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 20; $i++) {
            $article = new Article();
            $article->setTitle($faker->sentence())
                ->setContent($faker->text(mt_rand(500, 750)))
                ->setImage("http://placehold.it/350x150")
                ->setCreatedAt(new \DateTime())
                ->setSlug($faker->slug());

            $manager->persist($article);
        }

        $manager->flush();
    }
}
