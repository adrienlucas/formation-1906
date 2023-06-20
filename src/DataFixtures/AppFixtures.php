<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $actionGenre = new Genre();
        $actionGenre->setName('Action');

        $scifiGenre = new Genre();
        $scifiGenre->setName('Sci-Fi');

        $comedyGenre = new Genre();
        $comedyGenre->setName('Comedy');

        $dramaGenre = new Genre();
        $dramaGenre->setName('Drama');

        $movie = new Movie();
        $movie->setTitle('The Shawshank Redemption');
        $movie->setReleasedAt(new \DateTimeImmutable('1994-10-14'));
        $movie->addGenre($actionGenre);
        $movie->addGenre($scifiGenre);
        $manager->persist($movie);

        $movie = new Movie();
        $movie->setTitle('The Godfather');
        $movie->setReleasedAt(new \DateTimeImmutable('1972-03-24'));
        $movie->addGenre($dramaGenre);
        $movie->addGenre($actionGenre);
        $manager->persist($movie);

        $movie = new Movie();
        $movie->setTitle('The Dark Knight');
        $movie->setReleasedAt(new \DateTimeImmutable('2008-07-18'));
        $movie->addGenre($actionGenre);
        $movie->addGenre($dramaGenre);
        $manager->persist($movie);

        $movie = new Movie();
        $movie->setTitle('The Batman');
        $movie->setReleasedAt(new \DateTimeImmutable('2022-03-04'));
        $movie->addGenre($actionGenre);
        $movie->addGenre($dramaGenre);
        $manager->persist($movie);

        $movie = new Movie();
        $movie->setTitle('The Lord of the Rings: The Return of the King');
        $movie->setReleasedAt(new \DateTimeImmutable('2003-12-17'));
        $movie->addGenre($actionGenre);
        $manager->persist($movie);

        $movie = new Movie();
        $movie->setTitle('The Hangover');
        $movie->setReleasedAt(new \DateTimeImmutable('2009-06-05'));
        $movie->addGenre($comedyGenre);
        $manager->persist($movie);
        
        $manager->flush();
    }
}

/**
 * class Movie
{
#[ORM\Id]
#[ORM\GeneratedValue]
#[ORM\Column]
private ?int $id = null;

#[ORM\Column(length: 255)]
private ?string $title = null;

#[ORM\Column]
private ?\DateTimeImmutable $releasedAt = null;

#[ORM\Column(type: Types::TEXT, nullable: true)]
private ?string $plot = null;

#[ORM\ManyToMany(targetEntity: Genre::class, mappedBy: 'movies')]
private Collection $genres;

 */