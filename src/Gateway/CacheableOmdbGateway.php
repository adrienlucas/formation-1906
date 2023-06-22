<?php
declare(strict_types=1);

namespace App\Gateway;

use App\Entity\Movie;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsDecorator(OmdbGateway::class)]
class CacheableOmdbGateway extends OmdbGateway
{
    public function __construct(
        private OmdbGateway $omdbGateway,
        private CacheInterface $cache,
    ) {
    }

    public function getPoster(Movie $movie): string
    {
        $cacheKey = 'poster_'.md5($movie->getTitle());
        return $this->cache->get($cacheKey, function(ItemInterface $cacheItem) use ($movie): string {
            $cacheItem->expiresAfter(10);
            return $this->omdbGateway->getPoster($movie);
        });
    }
}