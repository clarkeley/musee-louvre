<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShopControllerTest extends WebTestCase
{
    public function testValidForm()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/billetterie');

        $form = $crawler->selectButton('Ajouter')->form();

        $client->submit($form, ['shop[date]' => '2019-03-20',
            'shop[type]' => 'Journée',
            'shop[quantite]' => 1,
            'shop[email]' => 'toto@gmail.com',]);

        $this->assertTrue($client->getResponse()->isRedirect());
    }
}
