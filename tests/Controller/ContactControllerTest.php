<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 05/03/2019
 * Time: 14:33
 */

namespace App\Tests\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    public function testValidData()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/contact');

        $buttonCrawlerNode = $crawler->selectButton('Envoyer');

        $form = $buttonCrawlerNode->form([
            'contact[username]' => 'Toto',
            'contact[from]' => 'toto@gmail.com',
            'contact[message]' => 'message',
        ]);

        $client->submit($form);

        $mailCollector = $client->getProfile()->getCollector('swiftmailer');


        $this->assertSame(1, $mailCollector->getMessageCount());
        $this->assertTrue($client->getResponse()->isRedirect());
    }
}