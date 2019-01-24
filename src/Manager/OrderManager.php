<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 24/01/2019
 * Time: 14:19
 */

namespace App\Manager;


use App\Entity\Order;
use App\Entity\Ticket;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OrderManager
{
    const SESSION_KEY = 'order';
    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function getNewOrder()
    {
        $order =  new Order();
        $this->session->set(self::SESSION_KEY,$order);
        return $order;
    }

    public function getCurrentOrder()
    {
        return $this->session->get(self::SESSION_KEY);
    }

    /**
     * @param $order
     */
    public function generateTickets(Order  $order): void
    {
        for ($i = 1; $i <= $order->getQuantite(); $i++) {
            $order->addTicket(new Ticket());
        }
    }

}