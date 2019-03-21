<?php

namespace App\Tests;

use App\Entity\Order;
use App\Entity\Ticket;
use App\Manager\OrderManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrderTicketsControllerTest extends WebTestCase
{
    public function testCollection()
    {
        $client = static::createClient();

        $session = $client->getContainer()->get("session");

        $order = new Order();

        $order->setDate(new \DateTime('2019-03-20'))
            ->setType('Journée')
        ->setQuantite(1)
            ->addTicket(new Ticket())
            ->setEmail('toto@gmail.com');

        $session->set(OrderManager::SESSION_KEY, $order);
        $session->save();

        $crawler = $client->request('GET', '/tickets');



        $form = $crawler->selectButton('Continuer')->form();


        $form['order_tickets[tickets][0][prenom]'] = 'Toto';
        $form['order_tickets[tickets][0][nom]'] = 'toto';
        $form['order_tickets[tickets][0][pays]'] = 'FR';
        $form['order_tickets[tickets][0][anniversaire]'] = '1995-05-19';

//        $values['tickets'][0]['reduction'] = 0;

        $crawler = $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect());
    }
}
