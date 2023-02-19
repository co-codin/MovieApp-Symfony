<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieFormType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    private EntityManagerInterface $em;
    private MovieRepository $movieRepository;
    public function __construct(EntityManagerInterface $em, MovieRepository $movieRepository)
    {
        $this->em = $em;
        $this->movieRepository = $movieRepository;
    }


    #[Route('/movies', name: 'movies')]
    public function index(): Response
    {
        $movieRepository = $this->em->getRepository(Movie::class);

        $movies = $movieRepository->findAll();

        return $this->render('movies/index.html.twig', [
            'movies' => $movies
        ]);
    }

    #[Route('/movies/{id}', name: 'show_movie', methods: ['GET'])]
    public function show($id): Response
    {
        $movie = $this->movieRepository->find($id);

        return $this->render('movies/show.html.twig', [
            'movie' => $movie
        ]);
    }

    #[Route('/movies', name: 'create_movie')]
    public function create(Request $request): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieFormType::class, $movie);

    }

    #[Route('/movies/{id}', name: 'delete_movie', methods: ['DELETE'])]
    public function delete($id)
    {

    }

    private function checkLoggedInUser($movieId)
    {

    }
}
