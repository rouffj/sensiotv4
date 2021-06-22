<?php

namespace App\Controller;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * @Route("/movie/{id}", requirements={"id": "\d+"}, defaults={"id": 1})
     */
    public function details($id, EntityManagerInterface $entityManager): Response
    {
        $movie = $entityManager->getRepository(Movie::class)->findOneBy(['id' => $id]);

        return $this->render('movie/details.html.twig', [
            'movie' => $movie
        ]);
    }

    /**
     * @Route("/movie/top-rated")
     */
    public function topRated(): Response
    {
        return $this->render('movie/top-rated.html.twig');
    }

    /**
     * @Route("/movie/genres")
     */
    public function genres(): Response
    {
        return $this->render('movie/genres.html.twig');
    }

    /**
     * @Route("/movie/latest")
     */
    public function latest(): Response
    {
        return $this->render('movie/latest.html.twig');
    }

    ///**
    // * @Route("/movie/{id}", name="movie", requirements={"id": "\d+"}, defaults={"id": 1}, methods={"POST"})
    // */
    //public function index($id): Response
    //{
    //    return new Response('Nice to meet you ' . $id, 200);
    //    //return $this->json([
    //    //    'message' => 'Welcome to your new controller!',
    //    //    'path' => 'src/Controller/MovieController.php',
    //    //]);
    //}

    /**
     * @Route("/movie/top-rated")
     */
    public function index2(): Response
    {
        return new Response('<html><body>top rated page</body></html>');
    }
}
