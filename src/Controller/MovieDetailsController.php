<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieDetailsController extends AbstractController
{
    #[Route('/movie/details/{id}', name: 'app_movie_details')]
    public function index(Movie $movie): Response
    {
        return $this->render('movie_details/index.html.twig', [
            'movie' => $movie
        ]);
    }
}
