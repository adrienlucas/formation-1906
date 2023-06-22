<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieCreateController extends AbstractController
{
    public function __construct(
        private MovieRepository $movieRepository,
    )
    {
    }

    #[Route('/movie/create', name: 'app_movie_create')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(MovieType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $movie = $form->getData();

            $this->movieRepository->save($movie, true);

            $this->addFlash('success', 'Le film a été créé.');
            return $this->redirectToRoute('app_movie_details', ['id' => $movie->getId()]);
        }

        return $this->render('movie_create/index.html.twig', [
            'movieForm' => $form,
        ]);
    }
}
