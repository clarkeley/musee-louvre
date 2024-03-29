<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AppUrlsTest extends WebTestCase

{
    /**
     * @dataProvider urlProvider
     * @param $url
     * @param $expectedStatus
     */
    public function testPageIsSuccessful($url, $expectedStatus)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertSame($client->getResponse()->getStatusCode(), $expectedStatus);
    }

    public function urlProvider()
    {
        yield ['/', Response::HTTP_OK];
        yield ['/billetterie', Response::HTTP_OK];
        yield ['/tickets', Response::HTTP_FOUND];
        yield ['/panier', Response::HTTP_FOUND];
        yield ['/success', Response::HTTP_FOUND];
        yield ['/contact', Response::HTTP_OK];
        yield ['/mentions', Response::HTTP_OK];
    }
}
