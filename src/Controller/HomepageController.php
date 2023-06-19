<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    #[Route('/hello/{name}', name: 'app_hello', requirements: ['name' => '\w+'])]
    public function index(Request $request, string $name = null): Response
    {
        return $this->render('homepage/index.html.twig', [
            'message' => sprintf('Hello %s!', $name ?? $request->query->get('name', 'world')),
        ]);
    }
}
