<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MovieControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/movie/22'); // Inception

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Inception');

        $reviewSelector = '.row.p-sm-5';
        $this->assertEquals(0, $crawler->filter($reviewSelector)->count());

        $crawler = $client->request('GET', '/movie/19'); // Memento
        $this->assertEquals(2, $crawler->filter($reviewSelector)->count(), 'Memento movie should have only 2 reviews');
    }
}
