<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    #[Route('/hello/{name}', name: 'app_hello', requirements: ['name' => '\w+'])]
    public function __invoke(Request $request, string $name = null): JsonResponse
    {
        return $this->json([
            'message' => sprintf('Hello %s!', $name ?? $request->query->get('name', 'world')),
            'path' => 'src/Controller/HomepageController.php',
        ]);
    }
}
