<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class ArticleFixtures extends Fixture
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');


        for ($i = 1; $i <= 20; $i++) {
            $article = new Article();
            $article->setTitle($faker->sentence())
                ->setContent($faker->text(mt_rand(3000, 9000)))
                ->setResume($faker->text(mt_rand(450, 900)))
                ->setImage("http://placehold.it/350x150")
                ->setCreatedAt(new \DateTime())
                ->setSlug(strtolower($this->slugger->slug($article->getTitle())));

            $manager->persist($article);
        }

        $manager->flush();
    }
}
