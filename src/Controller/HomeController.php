<?php

namespace App\Controller;

use App\Repository\FilmRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index( FilmRepository $filmRepository,
                           PaginatorInterface $pagination,
                           $page = 1 )
    {
        $filmQuery = $filmRepository
                        ->createQueryBuilder( 'f' )
                        ->orderBy( 'f.id', 'asc' )
                        ->getQuery();
        $film = $pagination->paginate( $filmQuery, (int)$page, 20 );

        

        /*$orderBy = $request->get('orderBy');
        $filmQueryBuilder = $filmRepository
            ->createQueryBuilder('f');

        if ($orderBy && in_array($orderBy, ['date_sortie ', 'event'])) {
            $filmQueryBuilder->orderBy('f.' . $orderBy, 'DESC');
        }

        $filmQuery = $filmQueryBuilder->getQuery();

        $filmQueryBuilder->orderBy('brigitte', 'DESC');

        $filmQueryOrderedByBrigitte = $filmQueryBuilder->getQuery();

        $film = $pagination->paginate($filmQuery, (int) $page, 100);

        $filmOrderedByBrigitte = $pagination->paginate($filmQueryOrderedByBrigitte, (int) $page, 100);

        return $this->render('home/index.html.twig', [
            'films' => $film,
            'filmOrderedByBrigitte' => $filmOrderedByBrigitte
        ]); */

        return $this->render('home/index.html.twig', [
            'films' => $film,
        ]);
    }
    /**
 * @Route("/contact", name="contact")
 */
    public function contact()
    {
        return $this->render('home/contact.html.twig', [
            'contact' => 'HomeController',
        ]);
    }
    /**
     * @Route("/about", name="aboutus")
     */
    public function about()
    {
        return $this->render('home/aboutus.html.twig', [
            'about' => 'HomeController',
        ]);
    }
}
