<?php

namespace App\Tests;

use App\Entity\Order;
use App\Manager\OrderManager;
use App\Services\StripePaiement;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BasketControllerTest extends WebTestCase
{
    /**
     * @var OrderManager
     */
    private $OrderManager;

    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->OrderManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testStripe()
    {
        $order = new Order();
        $orderManager = $this->createMock(OrderManager::SESSION_KEY);
        //$stripe = $this->createMock(StripePaiement::class);

        $amount = 16;

        $paiement = new OrderManager($orderManager);

        $this->assertEquals($paiement->pay($order->setTotalPrice($amount)));
    }
}
