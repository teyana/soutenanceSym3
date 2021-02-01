<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Article;
use App\Entity\BlogCategory;
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

        for ($c = 0; $c < 5; $c++) {
            $blogCategory = new BlogCategory;
            $blogCategory->setName($faker->text(mt_rand(6, 20)))
                ->setSlug(strtolower($this->slugger->slug(
                    $blogCategory->getName()
                )));

            $manager->persist($blogCategory);

            for ($i = 1; $i <= mt_rand(15, 20); $i++) {
                $article = new Article();
                $article->setTitle($faker->sentence())
                    ->setContent($faker->text(mt_rand(3000, 9000)))
                    ->setResume($faker->text(mt_rand(450, 900)))
                    ->setImage("http://placehold.it/350x150")
                    ->setCreatedAt(new \DateTime())
                    ->setSlug(strtolower($this->slugger->slug($article->getTitle())))
                    ->setBlogCategory($blogCategory);

                $manager->persist($article);
            }
        }

        $manager->flush();
    }
}
