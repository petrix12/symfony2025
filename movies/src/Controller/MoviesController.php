<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MoviesController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager) {}

    #[Route('/movies', name: 'app_movies')]
    public function index(): Response {
        $movies = $this->entityManager->getRepository(Movie::class)->findAll();
        // $movies = null;
        // dd($movies);
        return $this->render('movies/index.html.twig', [
            'movies' => $movies
        ]);
    }

    #[Route('/movies/create', name: 'app_movie_create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($movie);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_movie', ['id' => $movie->getId()]);
        }

        return $this->render('movies/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/movies/{id}', name: 'app_movie', methods: ['GET'])]
    public function show(int $id): Response {
        $movie = $this->entityManager->getRepository(Movie::class)->find($id);
        //dd($id);

        if(!$movie) {
            throw $this->createNotFoundException('Movie not fount!');
        }
        return $this->render('movies/show.html.twig', [
            'movie' => $movie
        ]);
    }
}
