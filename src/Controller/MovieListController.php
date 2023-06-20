<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieListController extends AbstractController
{
    #[Route('/movie/list', name: 'app_movie_list')]

    public function index(
        MovieRepository $movieRepository): Response
    {
        //En utilisant findAll sur le repo, récupérer tous les films
        $movies = $movieRepository->findAll();

        return $this->render('movie_list/index.html.twig', [
            'movies' => $movies,
        ]);
    }
}
