<?php

namespace App\Tests\Manager;

use App\Entity\Order;
use App\Entity\Ticket;
use App\Manager\OrderManager;
use App\Services\StripePaiement;
use App\Services\SwiftMailer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

class OrderManagerTest extends TestCase
{
    /**
     * @var OrderManager
     */
    private $orderManager;

    /**
     * @var StripePaiement
     */
    private $stripePaiement;

    /**
     * @var SwiftMailer
     */
    private $swiftMailer;

    public function orderProvider()
    {
        return [
            ["2019-01-01", Order::TYPE_DEMI_JOURNEE, "1995-01-01", false, 8],
            ["2019-01-01", Order::TYPE_JOURNEE, "1995-01-01", false, 16],
            ["2019-01-01", Order::TYPE_JOURNEE, "1995-01-01", true, 10],
            ["2019-01-01", Order::TYPE_DEMI_JOURNEE, "1995-01-01", true, 5],
            // Ticket enfant de moins de 4 ans
            ["2019-01-01", Order::TYPE_JOURNEE, "2017-01-01", false, 0],
            ["2019-01-01", Order::TYPE_DEMI_JOURNEE, "2017-01-01", false, 0],
            ["2019-01-01", Order::TYPE_JOURNEE, "2017-01-01", true, 0],
            ["2019-01-01", Order::TYPE_DEMI_JOURNEE, "2017-01-01", true, 0],
            // Ticket enfant de moins de 12 ans
            ["2019-01-01", Order::TYPE_JOURNEE, "2009-01-01", false, 8],
            ["2019-01-01", Order::TYPE_DEMI_JOURNEE, "2009-01-01", false, 4],
            ["2019-01-01", Order::TYPE_JOURNEE, "2009-01-01", true, 8],
            ["2019-01-01", Order::TYPE_DEMI_JOURNEE, "2009-01-01", true, 4],
            // Ticket enfants et adulte de moins de 60 ans
            ["2019-01-01", Order::TYPE_JOURNEE, "1999-01-01", false, 16],
            ["2019-01-01", Order::TYPE_DEMI_JOURNEE, "1999-01-01", false, 8],
            ["2019-01-01", Order::TYPE_JOURNEE, "1999-01-01", true, 10],
            ["2019-01-01", Order::TYPE_DEMI_JOURNEE, "1999-01-01", true, 5],
            // Ticket adulte de plus de 60 ans
            ["2019-01-01", Order::TYPE_JOURNEE, "1930-01-01", false, 12],
            ["2019-01-01", Order::TYPE_DEMI_JOURNEE, "1930-01-01", false, 6],
            ["2019-01-01", Order::TYPE_JOURNEE, "1930-01-01", true, 10],
            ["2019-01-01", Order::TYPE_DEMI_JOURNEE, "1930-01-01", true, 5],


        ];
    }

    protected function setUp()
    {
        $session = new Session(new MockArraySessionStorage());

        $this->stripePaiement = $this->createMock(StripePaiement::class);
        $this->swiftMailer = $this->createMock(SwiftMailer::class);
        $this->orderManager = new OrderManager($session, $this->stripePaiement, $this->swiftMailer);
    }


    /**
     * @param $date
     * @param $type
     * @param $birthdate
     * @param $reduce
     * @param $expectedPrice
     * @dataProvider orderProvider
     * @throws \Exception
     */
    public function testPriceCalculator($date, $type, $birthdate, $reduce, $expectedPrice)
    {

        $order = new Order();

        $order->setDate(new \DateTime($date))
            ->setType($type);


        $ticket = new Ticket();

        $ticket->setAnniversaire(new \DateTime($birthdate));
        $ticket->setReduction($reduce);

        $order->addTicket($ticket);

        $this->orderManager->priceCalculator($order);

        $this->assertEquals($expectedPrice, $order->getTotalPrice());
    }
}
