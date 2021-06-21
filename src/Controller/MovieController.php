<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * @Route("/movie/{id}", name="movie", requirements={"id": "\d+"})
     */
    public function index($id): Response
    {
        return new Response('Nice to meet you ' . $id, 200);
        //return $this->json([
        //    'message' => 'Welcome to your new controller!',
        //    'path' => 'src/Controller/MovieController.php',
        //]);
    }
}
