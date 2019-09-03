<?php

namespace App\Controller;

use App\Allocine\Allocine;
use App\Entity\Cinema;
use App\Entity\Event;
use App\Entity\EventTest;
use App\Form\CreateEventType;
use App\Repository\CinemaRepository;
use App\Repository\EventTestRepository;
use App\Repository\EventUserRepository;
use App\Repository\FilmRepository;
use App\Repository\SeanceRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\EventUser;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventUserController extends AbstractController
{
    /**
     * @Route("/event/list/", name="list_event")
     * @param EventTestRepository  $eventTestRepository
     * @return Response
     */
    public function eventlistFilm(EventTestRepository  $eventTestRepository )
    {
        //$event = $eventUserRepository->find($id); => recherche sur notre tables crée auparavant - EventUserRepository $eventUserRepository

        // SELECT * FORM event
        $eventtests= $eventTestRepository ->findAll();

        return $this->render('event/listevent.html.twig', [
           // 'event' => $event

           'eventtests'=> $eventtests,

        ]);
    }
    //* Mettre les id pour les event list une fois enregister.

    /**
     * @Route("/event/}", name="event_film")
     */
    public function eventFilm(EventUserRepository $eventUserRepository, int $id)
    {
        $event = $eventUserRepository->find($id);

        return $this->render('event/joinevent.html.twig', [
            'event' => $event,
        ]);
    }
/* Route("/event/create", name="create_event") */

    /**
     *
     * @Route("/event/create/{code<\d+>}/{codeseance<\d+>}/{date<\d{4}-\d{2}-\d{2}\d{2}:\d{2}>}", name="create_event")
     * @param Allocine         $allocine
     * @param ObjectManager    $objectManager
     * @param Request          $request
     * @param SeanceRepository $seanceRepository
     * @param FilmRepository   $filmRepository
     * @param CinemaRepository $cinemaRepository
     * @param                  $code
     * @param                  $codeseance
     * @param                  $date
     * @param EventUser|null   $eventUser
     * @return Response
     */
    public function createEvent(
        Allocine $allocine,
        ObjectManager $objectManager,
        Request $request,
        SeanceRepository $seanceRepository,
        FilmRepository $filmRepository,
        CinemaRepository $cinemaRepository,
        $code,
        $codeseance,
        $date,
        EventUser $eventUser= null
    )
    {
        if($eventUser === null){
            $eventUser = new EventUser();
        }

        $createEvent = $this->createForm(CreateEventType::class, $eventUser);
        $createEvent->handleRequest($request);

        // FILM //
        $film = $filmRepository->findOneBy(
            array('code' => $code)
        );
        // dump($code);

        // CINEMA
        // $request->get('nom_cinema'); // $_GET['nom_cinema']
        //$nom_cinema= $request->get('nom_cinema');
        //dump($nom_cinema);
        //*$cinema = $cinemaRepository->findOneBy(
        //            array('nom_cinema' => $nom_cinema)
        //        );
        //dump($cinema);

        //On fixe sur paris comme perimetre
        $infos = $allocine->getSessionMovie(75001, $code, null, 100);
        //dump($infos);
        foreach ($infos['feed']['theaterShowtimes'] as $theaterShowtime) {


            foreach ($theaterShowtime['movieShowtimes'] as $movieShowtime) {
                //dump($movieShowtime);

                $filmtitre    = $movieShowtime['onShow']['movie']['title'];
                $lienallocine = $movieShowtime['onShow']['movie']['link']['0']['href'];
                //dump($lienallocine);

                foreach ($movieShowtime['scr'] as $jourseance) {
                    foreach ($jourseance['t'] as $t) {
                        //dump($codeseance);
                       // dump($t['code']);

                        if ($t['code'] == $codeseance) {
                            //dump($t);
                            // dump($jourseance['d']);
                            // dump($t['$']);
                            $seance = $t + ['date' => $jourseance['d'] . $t['$']];
                            // array('date' => date_create_from_format('Y-m-dH:i', $date) );
                            $nom_cinema = $theaterShowtime['place']['theater']['name'];
                            $adresse    = $theaterShowtime['place']['theater']['address'];
                           // dump($seance);

                            if (!$cinemaRepository->findOneBy(['code_cinema' => $theaterShowtime['place']['theater']['code']])) {
                                //dump($theaterShowtime );
                                $cinema = new Cinema();
                                $cinema->setCodeCinema($theaterShowtime['place']['theater']['code']);
                                $cinema->setChaineCinema($theaterShowtime['place']['theater']['cinemaChain']['$']);
                                $cinema->setNomCinema($theaterShowtime['place']['theater']['name']);
                                $cinema->setAdresse($theaterShowtime['place']['theater']['address']);
                                $cinema->setCodePostal($theaterShowtime['place']['theater']['postalCode']);
                                $cinema->setVille($theaterShowtime['place']['theater']['city']);

                                // on ajoute le cinema dans la base
                                $objectManager->persist($cinema);
                                $objectManager->flush();
                            }


                        }
                    }
                }
            }
        }
        // dump($code); // code du film
        // dump($seance); //info de l'array seance

        //Si on n'as pas de seance (possible)
        if(!isset($seance)){
            $seance = $t + ['date'=>$jourseance['d'].$t['$']];
        }

        // CodeSeance
        //$codeseance= $seance['code'] ;
       //dump($codeseance); //envoie le code de la seance

        //Date => Pour la recherche du date et heure
        $datejour = $jourseance['d'];
        //dump($datejour); //date de jour
        $horraire= $seance['$'] ;
        //dump($horraire); //date heure
        $dateseance= $seance['date'] ; //date complet formater
        //dump($dateseance);

        //            $nom_cinema= $theaterShowtime['place']['theater']['name'];
        //            $adresse= $theaterShowtime['place']['theater']['address"'];


        //*on ajoute l'event
        $eventTest = new EventTest();
            //dump($dateseance);
        $eventTest ->setDate(  date_create_from_format('Y-m-dH:i',$dateseance ) );
        $eventTest ->setFilm( $filmtitre );
        $eventTest ->setOrganisateur('root' );
        $eventTest ->setNbparticipant('4' );

        $objectManager->persist($eventTest);
        $objectManager->flush();



        if ($createEvent->isSubmitted() && $createEvent->isValid()) {
            $objectManager->persist($eventUser);
            $objectManager->flush();

        }
        return $this->render('event/create.html.twig', [
            'seance' => $seance,
            'film' => $film,
            'nom_cinema' => $nom_cinema,
            'adresse' => $adresse,
            'codeseance' => $codeseance,
            'filmtitre' => $filmtitre,
            'datejour'=>$datejour,
            'horraire'=>$horraire,
            'lienallocine'=>$lienallocine,

            'create' => $createEvent->createView(),
        ]);
    }

}
