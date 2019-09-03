<?php

namespace App\Command;

use App\Allocine\Allocine;
use App\Entity\Film;
use App\Repository\FilmRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// Pour la commande :php bin/console app:fetch-fresh-movie

class FetchFreshMoviesCommand extends Command
{
    protected static $defaultName = 'app:fetch-fresh-movies';

    private $allocine;
    private $objectManager;
    private $filmRepository;

    public function __construct(Allocine $allocine, ObjectManager $manager, FilmRepository $filmRepository)
    {
        parent::__construct();
        $this->allocine = $allocine;
        $this->objectManager = $manager;
        $this->filmRepository = $filmRepository;
    }

    protected function configure()
    {
        $this
            ->setDescription('Update the list of "fresh" movies')
            // ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            // ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        // $arg1 = $input->getArgument('arg1');

        // if ($arg1) {
        //     $io->note(sprintf('You passed an argument: %s', $arg1));
        // }

        // if ($input->getOption('option1')) {
        //     // ...
        // }
        $page = 1;

        $this->filmRepository->createQueryBuilder('f')
            ->update(Film::class, 'f')
            ->set('f.fresh', 0)
            ->getQuery()
            ->execute();
        $movies = []; // ['23456' => Movie]

        do {

            $showtimes = $this->allocine->getSessionMovie(75001, null, null, 100, $page);

            // TODO : périmer tous les films
            
            foreach ($showtimes['feed']['theaterShowtimes'] as $theaterShowtime) {
                foreach ($theaterShowtime['movieShowtimes'] as $movieShowtime) {
                    $movieApiInfos = $movieShowtime['onShow']['movie'];
                    if (isset($movies[$movieApiInfos['code']])) {
                        continue;
                    }
                    $movies[$movieApiInfos['code']] = $movieApiInfos;
                }
            }
            $page++;
        } while ($page <= $showtimes['feed']['totalResults'] / $showtimes['feed']['count']);

        // TODO : dépérimer tous les films dont les codes sont dans movies
        $moviesCodes = array_keys($movies);
        // UPDATE film SET fresh = 1 WHERE code in (...moviesCode...)
        $this->filmRepository->createQueryBuilder('f')
            ->update(Film::class, 'f')
            ->set('f.fresh', 1)
            ->where('f.code IN (:codes)')
            ->setParameter('codes', $moviesCodes)
            ->getQuery()
            ->execute();

        $alreadyExistingMovies = $this->filmRepository->findBy(['code' => $moviesCodes]);
        $movies = array_diff_key($movies, array_flip(array_map(function ($film) {
            return $film->getCode();
        }, $alreadyExistingMovies)));
        // TODO ? : filtrer les films déjà présents en base
        foreach ($movies as $movieApiInfos) {
            $movie = new Film();
            $movie->setCode($movieApiInfos['code']);
            if (isset($movieApiInfos['release']['releaseDate'])) {
                $date = date_create_from_format('Y-m-d', $movieApiInfos['release']['releaseDate']);
                if (!$date) {
                    $date = date_create_from_format('Y-m', $movieApiInfos['release']['releaseDate']);
                }
                if (!$date) {
                    $date = date_create_from_format('Y', $movieApiInfos['release']['releaseDate']);
                }

                $movie->setDateSortie($date);
            }
            $movie->setDirecteurs($movieApiInfos['castingShort']['directors'] ?? '');
            // $movie->setActors($movieApiInfos['castingShort']['actors'] ?? '');
            $movie->setImage($movieApiInfos['poster']['href'] ?? '');
            $movie->setLienFilm($movieApiInfos['link'][0]['href'] ?? '');
            $movie->setRestriction($movieApiInfos['movieCertificate']['certificate']['$'] ?? '');
            $movie->setTitre($movieApiInfos['title']);
            $movie->setGenre($movieApiInfos['genre'][0]['$'] ?? '');
            $movie->setFresh(true);
            $movies[$movieApiInfos['code']] = $movie;
            $this->objectManager->persist($movie);
        }
        $this->objectManager->flush();


        $io->success('Fresh movies list updated.');
    }
}
