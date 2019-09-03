<?php

namespace App\Controller;

use App\Allocine\Allocine;
use App\Repository\FilmRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    /**
     * @Route("/search/{page}", name="search")
     */
    public function search(Request $request, 
        FilmRepository $filmRepository,
                           $page = 1 )
    {
        $search = $request->get('search'); // $_GET['search]
        $films = $filmRepository->createQueryBuilder('f')
        ->where('f.titre LIKE :titre')
        ->setParameter('titre', "%$search%")
        ->getQuery()
        ->getResult();
        return $this->render('search/index.html.twig', [
            'films' => $films,
        ]);
    }
}  
