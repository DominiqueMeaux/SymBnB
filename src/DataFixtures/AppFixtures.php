<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Faker\Factory;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr-FR');

        

        for ($i = 1; $i <= 30; $i++) {
            $ad = new Ad();

            // sentence ente 0 et 6 mots environ
            $title = $faker->sentence();
            
            $coverImage = $faker->imageUrl(1000, 350);
            // le 2 représente le nb de phrase lorem voulu
            $introduction = $faker->paragraph(2);
            // Pour plusieurs paragraphs faker renvoi un tableau il faut donc mettre en forme pour avoir un truc propre
            $content = '<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>';

            $ad->setTitle($title)
                ->setCoverImage($coverImage)
                ->setIntroduction($introduction)
                ->setContent($content)
                // mt_rand = random de ... à ...
                ->setPrice(mt_rand(40, 200))
                ->setRooms(mt_rand(1, 5));
            // $product = new Product();
            // persist dans le temps

            for($j = 1; $j <= mt_rand(2, 5); $j++){
                $image = new Image();

                $image->setUrl($faker->imageUrl())
                    ->setCaption($faker->sentence())
                    ->setAd($ad);

                    $manager->persist($image);

            }


            $manager->persist($ad);
        }

        $manager->flush();
    }
}
