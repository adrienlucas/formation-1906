<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieDetailsController extends AbstractController
{
    #[Route('/movie/details', name: 'app_movie_details')]
    public function index(): Response
    {
        return $this->render('movie_details/index.html.twig', [
            'movie' => [
                'title' => 'Terminator 2',
                'releasedAt' => new \DateTime('1991-07-01'),
                'genres' => [
                    'Action', 'Sci-Fi'
                ]
            ]
        ]);
    }
}
