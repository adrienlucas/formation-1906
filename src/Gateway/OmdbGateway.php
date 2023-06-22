<?php
declare(strict_types=1);

namespace App\Gateway;

use App\Entity\Movie;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OmdbGateway implements OmdbGatewayInterface
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private string $apiKey,
    )
    {
    }

    public function getPoster(Movie $movie): string
    {
        $response = $this->httpClient->request('GET', sprintf(
            'https://www.omdbapi.com/?apikey=%s&t=%s',
            $this->apiKey,
            $movie->getTitle(),
        ));

        $json = $response->toArray();

        return $json['Poster'] ?? '';
    }
}