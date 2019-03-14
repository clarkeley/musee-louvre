<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AppUrlsTest extends WebTestCase

{
    /**
     * @dataProvider urlProvider
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
        yield ['/tickets', Response::HTTP_OK];
        yield ['/panier', Response::HTTP_INTERNAL_SERVER_ERROR];
        yield ['/success', Response::HTTP_INTERNAL_SERVER_ERROR];
        yield ['/contact', Response::HTTP_OK];
        yield ['/mentions', Response::HTTP_OK];
    }
}
