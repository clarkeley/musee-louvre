<?php

namespace App\Tests;

use App\Entity\Order;
use App\Entity\Ticket;
use App\Manager\OrderManager;
use App\Services\StripePaiement;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BasketControllerTest extends WebTestCase
{
    public function testPay()
    {
        $client = static::createClient();

        $session = $client->getContainer()->get("session");

        $order = new Order();

        $order->setDate(new \DateTime('2019-03-20'))
            ->setType('Journée')
            ->setQuantite(1)
            ->addTicket(new Ticket())
            ->setEmail('toto@gmail.com')
            ->setTotalPrice(16);

        $session->set(OrderManager::SESSION_KEY, $order);

        $tickets = new Ticket();

        $tickets->setPrenom('toto')
                ->setNom('Toto')
                ->setPays('FR')
                ->setAnniversaire(new \DateTime('1995-05-19'));

        $session->set(OrderManager::SESSION_KEY, $tickets);

        $session->save();

        $orderManager = $this->createMock(OrderManager::SESSION_KEY);

        $orderManager->expects($this->once())->method("pay")->willReturn($order);

        $this->assertEquals(true, $orderManager);

        //$this->assertEquals('true', $orderManager->method(pay));
    }
}
