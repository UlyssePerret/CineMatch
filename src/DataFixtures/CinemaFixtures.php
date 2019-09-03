<?php

namespace App\DataFixtures;

use App\Entity\Cinema;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class CinemaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $cinema = new Cinema();

            $cinema->setCodeCinema($faker->randomNumber($nbDigits = NULL, $strict = false));
            $cinema->setNomCinema($faker->name);
            $cinema->setChaineCinema('');
            $cinema->setAdresse($faker->streetAddress) ;
            $cinema->setCodePostal($faker->postcode);
            $cinema->setVille($faker->city);


            $manager->persist($cinema);
        }

        $manager->flush();
    }
}
