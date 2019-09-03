<?php

namespace App\DataFixtures;

use App\Entity\Film;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;


class FilmFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /*$faker = Factory::create( 'fr_FR' );

        for ($i = 0; $i < 20; $i++) {
            $film = new Film();


            $film->setCode($faker->numberBetween($min = 0, $max = 2147483647));
            $film->setTitre($faker->name);
            $film->setImage($faker->imageUrl($width = 640, $height = 480) );
            $film->setDateSortie($faker->dateTime($max = 'now', $timezone = null) );
            $film->setLienFilm('http://www.allocine.fr/film/fichefilm_gen_cfilm='.$i.'.html');
            $film->setLangue($faker->languageCode);
            $film->setDirecteurs($faker->name);
            $film->setRestriction('pas de restriction');


            $manager->persist($film);
        }

        $manager->flush();*/
    }
}
