<?php

namespace App\Controller;

use App\Allocine\Allocine;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowtimeController extends AbstractController
{
    /**
     * @Route("/showtime", name="showtime")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(Allocine $allocine)
    {
        $showtimes = $allocine->getSessionMovie( 36230, null, null, 100 );
        $showtimes = $allocine->getSessionMovie( 75001, null, null, 100, 2 );
        return $this->render('showtime/index.html.twig', [
            'showtimes' => $showtimes,
        ]);
    }
}
