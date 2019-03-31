<?php

namespace App\Tests;

use App\Controller\ShopSuccessController;
use App\Entity\Order;
use App\Entity\Ticket;
use App\Exception\NoCurrentOrderException;
use App\Manager\OrderManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShopSuccessControllerTest extends WebTestCase
{
    public function testShowSuccess()
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

        $showSuccess = $this->createMock(ShopSuccessController::class);

        //$showSuccess->expects($this->once())->method("showSucess")->willReturn();

        try {
            $this->assertEquals(true, $showSuccess->showSuccess()->isSuccessful());
        } catch (NoCurrentOrderException $e) {
        }
    }
}
