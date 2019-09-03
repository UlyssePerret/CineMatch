<?php

namespace App\Controller;

use App\Allocine\Allocine;
use App\Repository\FilmRepository;
use App\Repository\SeanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoirSeanceController extends AbstractController
{
    /**
     * @Route("/voir/seance/{code<\d+>}", name="voir_seance")
     * @param FilmRepository $filmRepository
     * @param Allocine       $allocine
     * @param int            $code
     * @return Response
     */
    public function index(FilmRepository $filmRepository, Allocine $allocine, $code)
    {
        $film = $filmRepository->findOneBy(
            array('code' => $code)
        );
        // $showtimes = $allocine->getSessionMovie($zip , $movie , $date , $radius );


        $seance = $allocine->getSessionMovie( 36230, $code, null, 100 );
        $seance= $allocine->getSessionMovie( 75001, $code, null, 100 );

        return $this->render('voir_seance/index.html.twig', [
            'seance' => $seance,
            'film' => $film,
        ]);
    }
}
