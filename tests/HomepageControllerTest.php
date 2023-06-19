<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomepageControllerTest extends WebTestCase
{
    public function testTheHomepageSaysHello(): void
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $returnedData = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('message', $returnedData);
        $this->assertSame('Hello world!', $returnedData['message']);
    }

    /**
     * @dataProvider provideHelloPageSuffixes
     */
    public function testTheHelloPageSaysHello(string $urlSuffix, string $expectedHello): void
    {
        $client = static::createClient();

        $client->request('GET', '/hello'.$urlSuffix);

        $this->assertResponseIsSuccessful();
        $returnedData = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('message', $returnedData);
        $this->assertSame($expectedHello, $returnedData['message']);
    }

    public function provideHelloPageSuffixes(): iterable
    {
        return [
            'common' => ['/adrien', 'Hello adrien!'],
            'empty' => ['', 'Hello world!'],
            'numeric' => ['/00000', 'Hello 00000!'],
        ];
    }
}
