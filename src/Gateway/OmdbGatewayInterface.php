<?php
declare(strict_types=1);

namespace App\Gateway;

use App\Entity\Movie;

interface OmdbGatewayInterface
{
    public function getPoster(Movie $movie): string;
}