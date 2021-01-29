<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 20; $i++) {
            $article = new Article();
            $article->setTitle("Titre de l'article n$i")
                ->setContent("<p>Contenu de l'article n$i . Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque vitae laudantium autem tenetur repellendus iusto quis quo aliquam ipsam explicabo ipsum quod inventore velit tempore facere ea ad sequi itaque vero, doloribus temporibus ut. Ipsum rem vero asperiores eveniet, alias mollitia maxime delectus voluptas necessitatibus id iste deleniti blanditiis iure.</p>")
                ->setImage("http://placehold.it/350x150")
                ->setCreatedAt(new \DateTime());

            $manager->persist($article);
        }

        $manager->flush();
    }
}
