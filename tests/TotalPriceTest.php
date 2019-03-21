<?php

namespace App\Tests;

use App\Entity\Order;
use App\Entity\Ticket;
use App\Manager\OrderManager;
use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\Validator\Constraints\Date;

class TotalPriceTest extends WebTestCase
{
    /**
     * @var OrderManager
     */
    private $OrderManager;

    protected function setUp()
    {
        $session = new Session(new MockArraySessionStorage());

        $this->OrderManager = new OrderManager($session);
    }

    public function testValidateCalcul()
    {
        $date = "2019-03-20";
        $order = new Order();
        $order->setDate($date);
        $ticket = new Ticket();
        $ticket->getAge();

        $ticketRepository = $this->createMock(TicketRepository::class);

        $orderManager = $this->createMock(OrderManager::SESSION_KEY);


        $totalPrice = new OrderManager($orderManager);
        $this->assertEquals($totalPrice->priceCalculator());
    }
}
