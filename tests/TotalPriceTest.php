<?php

namespace App\Tests;

use App\Entity\Order;
use App\Entity\Ticket;
use App\Manager\OrderManager;
use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TotalPriceTest extends WebTestCase
{
    const PRICE_1 = 10;
    const PRICE_2 = 16;

    public function testValidateCalcul()
    {
        $tickets = new Ticket();
        $tickets->setPrice(self::PRICE_1);
        $tickets->setPrice(self::PRICE_2);

        $ticketRepository = $this->createMock(TicketRepository::class);
        $ticketRepository->expects($this->any())
            ->method('find')
            ->willReturn($tickets);

        $orderManager = $this->createMock(OrderManager::SESSION_KEY);
        $orderManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($ticketRepository);

        $totalPrice = new OrderManager($orderManager);
        //$this->assertEquals()
    }
}
