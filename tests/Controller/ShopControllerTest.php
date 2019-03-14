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

        $values = $form->getPhpValues();

        $values['billetterie']['date'] = '20/03/2019';
        $values['billetterie']['type'] = 'Journée';
        $values['billetterie']['quantite'] = 1;
        $values['billetterie']['email'] = 'toto@gmail.com';

        $crawler = $client->request($form->getMethod(), $form->getUri(), $values, $form->getFiles());

        $this->assertEquals(4, $crawler->filter('div.form-group')->count());

        //$this->assertTrue($client->getResponse()->isRedirect());

    }
}
