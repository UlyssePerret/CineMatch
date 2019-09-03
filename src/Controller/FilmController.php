<?php

namespace App\Controller;

use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    /**
     * @Route("/film/{id<\d+>}", name="film")
     */
    public function index(FilmRepository $filmRepository, int $id)
    {
        $film = $filmRepository->find($id);
        //dump($film);

        return $this->render('film/index.html.twig', [
            'film' => $film,
        ] );
    }
}
