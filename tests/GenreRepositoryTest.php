<?php
declare(strict_types=1);

    class GenreRepositoryTest extends \Symfony\Bundle\FrameworkBundle\Test\KernelTestCase
{
    public function testSomething()
    {
        $container = self::getContainer();
        $repository = $container->get(\App\Repository\GenreRepository::class);

        var_dump(get_class($repository));
    }
}