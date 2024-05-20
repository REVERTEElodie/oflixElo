<?php
// Fichier : MovieTestController.php | Date: 2024-01-22 | Auteur: Patrick SUFFREN

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Season;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieTestController extends AbstractController
{
    #[Route('/movie/test', name: 'app_movie_test_browse')]
    public function browse(MovieRepository $movieRepository): Response
    {
        // l'objet de browse est d'afficher l'ensemble des données de l'entité Movie
        // on récupère toutes les movies
        $movies = $movieRepository->findAll();
        // on obtient un tableau de movie[]
        dd($movies);
        return $this->render('movie_test/index.html.twig', [
            'controller_name' => 'MovieTestController',
        ]);
    }

    #[Route('/genre/test', name: 'app_genre_test_browse')]
    public function genreBrowse(GenreRepository $genreRepository): Response
    {
        // l'objet de browse est d'afficher l'ensemble des données de l'entité Movie
        // on récupère toutes les movies
        $genres = $genreRepository->findAll();
        // on obtient un tableau de movie[]
        dd($genres);
        return $this->render('movie_test/index.html.twig', [
            'controller_name' => 'MovieTestController',
        ]);
    }

    #[Route('/movie/test/add', name: 'app_movie_test_add')]
    public function add(EntityManagerInterface $entityManager): Response
    {
        // l'objet de add est d'ajouter un film à la base
        $movie = new Movie;
        $movie->setTitle('Apocalypse Now');
        $movie->setReleaseDate(new \DateTimeImmutable('26-09-1979'));
        $movie->setDuration(182);
        $movie->setSummary("Saïgon, le jeune capitaine Willard doit éliminer le colonel Kurtz");
        $movie->setSynopsis("Cloîtré dans une chambre d'hôtel de Saïgon, le jeune capitaine Willard, mal rasé et imbibé d'alcool, est sorti de sa prostration par une convocation de l'état-major américain. Le général Corman lui confie une mission qui doit rester secrète : éliminer le colonel Kurtz, un militaire aux méthodes quelque peu expéditives et qui sévit au-delà de la frontière cambodgienne. ");
        $movie->setPoster("http://4everstatic.com/images/850xX/art/film-et-serie/apocalypse-now-181365.jpg");
        $movie->setRating("4.8");
        $movie->setType("Film");

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($movie);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        dd($movie);

        return $this->render('movie_test/index.html.twig', [
            'controller_name' => 'MovieTestController',
        ]);
    }

    #[Route('/movie/test/{id<\d+>}', name: 'app_movie_test_read')]
    public function read(Movie $movie = null): Response
    {
        // l'objet de browse est d'afficher un Movie donné
        // on récupère le movie
        // $movie = $movieRepository->find($id);
        // on obtient un movie

        // on peut traiter manuellement l'absence du film en $id
        if ($movie === null) {
            throw $this->createNotFoundException("Désolé ce film n'est pas encore dans notre catalogue");
        }
        dd($movie);
        return $this->render('movie_test/index.html.twig', [
            'controller_name' => 'MovieTestController',
        ]);
    }

    #[Route('/movie/test/{id<\d+>}/edit', name: 'app_movie_test_edit')]
    public function edit(Movie $movie, EntityManagerInterface $entityManager): Response
    {
        // l'objet de edit est de modifier un film
        $movie->setDuration(245);

        // ajouter un genre à un film
        $genre = new Genre();
        $genre->setName('Science-fiction');
        $entityManager->persist($genre);

        // on rajoute le $genre au $movie
        $movie->addGenre($genre);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        // A noter : $em->persist() pas utile ici car récupéré via Doctrine
        dd($movie);

        return $this->render('movie_test/index.html.twig', [
            'controller_name' => 'MovieTestController',
        ]);
    }

    #[Route('/movie/test/{id<\d+>}/delete', name: 'app_movie_test_delete')]
    public function delete(Movie $movie, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($movie);
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        // A noter : $em->persist() pas utile ici car récupéré via Doctrine
        dd($movie);

        return $this->render('movie_test/index.html.twig', [
            'controller_name' => 'MovieTestController',
        ]);
    }

    #[Route('/movie/test/fill', name: 'app_movie_test_fill')]
    public function fill(EntityManagerInterface $entityManager): Response
    {
        // on récupère les données de data.php soit le tableau $shows
        include(__DIR__ . '/../../sources/data.php');
        // dd($shows);
        // on insère dana le BDD les données du tableau
        foreach ($shows as $show) {
            // l'objet de add est d'ajouter un film à la base
            $movie = new Movie;
            $movie->setTitle($show['title']);
            $movie->setReleaseDate(new \DateTimeImmutable($show['release_date']));
            $movie->setDuration($show['duration']);
            $movie->setSummary($show['summary']);
            $movie->setSynopsis($show['synopsis']);
            $movie->setPoster($show['poster']);
            $movie->setRating($show['rating']);
            $movie->setType($show['type']);

            // on veut ausii rajouter des saisons aux séries
            if ($movie->getType() === 'Série') {
                // on crée une saison
                $season = new Season;
                $season->setNumber(1);
                $season->setEpisodesNumber(rand(6,12));
                // on doit associer la saison au film
                $season->setMovie($movie);
                // les deux sont équivalent, mais Symfony conseille de faire l'association du coté du owning side 
                // $movie->addSeason($season);
                $entityManager->persist($season);
            }

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($movie);
        }

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        return new Response('Création des films et des saisons OK');

        return $this->render('movie_test/index.html.twig', [
            'controller_name' => 'MovieTestController',
        ]);
    }
}