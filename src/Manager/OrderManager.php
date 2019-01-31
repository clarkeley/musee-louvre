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
use App\Services\StripePaiement;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OrderManager
{
    const SESSION_KEY = 'order';
    /**
     * @var SessionInterface
     */
    private $session;
    /**
     * @var StripePaiement
     */
    private $stripePaiement;

    public function __construct(SessionInterface $session, StripePaiement $stripePaiement)
    {
        $this->session = $session;
        $this->stripePaiement = $stripePaiement;
    }

    public function pay(Order $order)
    {
        $reference = $this->stripePaiement->doPaiement($order->getTotalPrice(), 'Commande Louvre');
        if ($reference){
            // assigner a ta commande la reference stripe
            // envoyer le mail de confirmation
            // enregistrer en bdd
            return true;
        }

        return false;
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

    public function priceCalculator(Order $order)
    {
        $totalPrice =0;

        foreach ($order->getTickets() as $ticket) {
            if ($ticket->getAge() < 4) {
                $ticket->setPrice(0);
            } elseif ($ticket->getAge() < 12) {
                $ticket->setPrice(8);
            } elseif ($ticket->getAge() < 60) {
                $ticket->setPrice(16);
            } else {
                $ticket->setPrice(12);
            }


            if ($ticket->getPrice() >= 10 && $ticket->getReduce()) {
                $ticket->setPrice(10);
            } else {
                $ticket->setReduce(false);
            }

            $totalPrice += $ticket->getPrice();
        }

        $order->setTotalPrice($totalPrice);
    }

}