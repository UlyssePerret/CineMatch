<?php

namespace App\Controller;

use App\Allocine\Allocine;
use App\Entity\Seance;
use App\Repository\FilmRepository;
use App\Repository\SeanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoirSeanceHorraireController extends AbstractController
{
    /**
     * @Route("/voir/seance/{code<\d+>}/{date<\d{4}-\d{2}-\d{2}>}", name="voirseancehorraire")
     * @param FilmRepository $filmRepository
     * @param Allocine       $allocine
     * @param int            $code
     * @return Response
     */
    public function index(FilmRepository $filmRepository, $code, SeanceRepository $seanceRepository, $date, Allocine $allocine)
    {
        $film = $filmRepository->findOneBy(
            array('code' => $code)
        );

        //* si besoin format YYYY-MM-DD
        //* format: 'yyyy-mm-dd'
        /* $seance = $seanceRepository->findBy(
        //
        //            array('date' => date_create_from_format($date, 'Y-m-d') )
        //
        //        );
        */

        // $showtimes = $allocine->getSessionMovie($zip , $movie , $date , $radius );

        //* par default on met le zip = 75001
        //* eventuellement comme amélioration on poura laisser l'utilisateur choisir

        $seance = $allocine->getSessionMovie(75001, $code, $date, 100);

        return $this->render('voirseancehorraire/index.html.twig', [
            'seance' => $seance,
            'film' => $film,
        ]);
    }
}

