<?php

namespace App\Controller;

use App\Omdb\OmdbClient;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Security\UserClassBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(MovieRepository $movieRepository, OmdbClient $omdbClient): Response
    {
        $movies = $movieRepository->findAll();
        $moviesFromDb = $omdbClient->requestBySearch('Lord of the rings');
        dump($moviesFromDb);

        return $this->render('index.html.twig', [
            'movies' => $movies
        ]);

    }
}