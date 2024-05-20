<?php
// Fichier : ReviewController.php | Date: 2024-01-22 | Auteur: Patrick SUFFREN

namespace App\Controller\Front;

use App\Entity\Movie;
use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ReviewController extends AbstractController
{
    #[Route('/review/{id<\d+>}', name: 'front_review_new')]
    public function new(EntityManagerInterface $entityManager, Movie $movie, Request $request, ReviewRepository $reviewRepository): Response
    {
        $review = new Review();
        // $review->setWatchedAt(new \DateTimeImmutable());
        $form = $this->createForm(ReviewType::class, $review);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // association du film courant avec la critique
            $review->setMovie($movie);

            // on persiste et on sauvegarde
            $entityManager->persist($review);
            // on doit sauvegarder pour mettre en base la dernière critique
            // et l'utiliser lors du calcul du rating du film
            $entityManager->flush();

            $this->addFlash('success', 'La critique a été ajouté au film.');

            // // on apelle une requête personnalisée qui calcule la moyenne
            // $averageRating = $reviewRepository->averageRating($movie);
            // // on modifie le Movie
            // $movie->setRating($averageRating);
            // // on sauvegarde
            // $entityManager->flush();

            // $this->addFlash('success', 'La nouvelle note du film est ' . $averageRating);

            // on retourne sur la page de détail du Movie
            return $this->redirectToRoute('front_main_show', ['slug' => $movie->getSlug()]);
        }

        return $this->render('front/review/new.html.twig', [
            'movie' => $movie,
            'form'  => $form,
        ]);
    }
}