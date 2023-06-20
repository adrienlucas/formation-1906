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
        $actionGenre = new Genre();
        $actionGenre->setName('Action');
        $manager->persist($actionGenre);

        $scifiGenre = new Genre();
        $scifiGenre->setName('Sci-Fi');
        $manager->persist($scifiGenre);

        $comedyGenre = new Genre();
        $comedyGenre->setName('Comedy');
        $manager->persist($comedyGenre);

        $dramaGenre = new Genre();
        $dramaGenre->setName('Drama');
        $manager->persist($dramaGenre);

        $movie = new Movie();
        $movie->setTitle('The Shawshank Redemption');
        $movie->setPlot('Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.');
        $movie->setReleasedAt(new \DateTimeImmutable('1994-10-14'));
        $movie->addGenre($actionGenre);
        $movie->addGenre($scifiGenre);
        $manager->persist($movie);

        $movie = new Movie();
        $movie->setTitle('The Godfather');
        $movie->setPlot('The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.');
        $movie->setReleasedAt(new \DateTimeImmutable('1972-03-24'));
        $movie->addGenre($dramaGenre);
        $movie->addGenre($actionGenre);
        $manager->persist($movie);

        $movie = new Movie();
        $movie->setTitle('The Dark Knight');

        $movie->setPlot('When the menace known as the Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham. The Dark Knight must accept one of the greatest psychological and physical tests of his ability to fight injustice.');
        $movie->setReleasedAt(new \DateTimeImmutable('2008-07-18'));
        $movie->addGenre($actionGenre);
        $movie->addGenre($dramaGenre);
        $manager->persist($movie);

        $movie = new Movie();
        $movie->setTitle('The Batman');
        $movie->setPlot('Bruce Wayne, Batman, battles both a sinister cabal of villains and several of his own inner demons as he defends the citizens of Gotham City.');
        $movie->setReleasedAt(new \DateTimeImmutable('2022-03-04'));
        $movie->addGenre($actionGenre);
        $movie->addGenre($dramaGenre);
        $manager->persist($movie);

        $movie = new Movie();
        $movie->setPlot('Gandalf and Aragorn lead the World of Men against Sauron\'s army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.');
        $movie->setTitle('The Lord of the Rings: The Return of the King');
        $movie->setReleasedAt(new \DateTimeImmutable('2003-12-17'));
        $movie->addGenre($actionGenre);
        $manager->persist($movie);

        $movie = new Movie();
        $movie->setTitle('The Hangover');
        $movie->setPlot('Three buddies wake up from a bachelor party in Las Vegas, with no memory of the previous night and the bachelor missing. They make their way around the city in order to find their friend before');
        $movie->setReleasedAt(new \DateTimeImmutable('2009-06-05'));
        $movie->addGenre($comedyGenre);
        $manager->persist($movie);

        $manager->flush();
    }
}
