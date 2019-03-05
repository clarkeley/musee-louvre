<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 05/03/2019
 * Time: 14:33
 */

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactTest extends WebTestCase
{
    public function testFormTrue()
    {
        $client = static::createClient();

        $client->request('GET', '/contact');

        $this->assertTrue(true);
    }

    public function testValidData()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/contact');

        $buttonCrawlerNode = $crawler->selectButton('Submit');

        $form = $buttonCrawlerNode->form([
            'form.username' => 'Toto',
            'form.from' => 'toto@gmail.com',
            'form.message' => 'message',
        ]);

        $client->submit($form);

        echo $client->getResponse()->getContent();

        /*
         $client = static::createClient();

        $crawler = $client->request('GET', '/templates/contact.html.twig');

        $form = $crawler->selectButton('Submit')->form();
        $form['form[username]'] = 'Toto';
        $form['form[from]'] = 'toto@gmail.com';
        $form['form[message]'] = 'message de toto';

        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());*/
    }

}