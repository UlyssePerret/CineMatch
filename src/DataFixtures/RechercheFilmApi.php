<?php

namespace App\DataFixtures;

use App\Allocine;
use App\Entity\Film;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RechercheFilmApi extends Fixture
{
    public function load(ObjectManager $manager)
    {
/*
        for(  )
        $film = new Film();
        $film->setCode(  );
        $film->setTitre(  );
        $film->setImage(  );
        $film->setDateSortie(  );
        $film->setLienFilm(  );
        $film->setLangue(  );
        $film->setDirecteurs(  );
        $film->setRestriction(  );

*/



        // $manager->persist($product);

        $manager->flush();
    }
}
