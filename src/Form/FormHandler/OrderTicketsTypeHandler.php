<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 19/12/2018
 * Time: 22:23
 */

namespace App\Form\FormHandler;

use App\Entity\Order;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OrderTicketsTypeHandler
{
    /**
     * @var SessionInterface
     */
    private $session;


    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Order $order */
            $order = $form->getData();

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


                if ($ticket->getPrice() >= 10 && $ticket->getRate()) {
                    $ticket->setPrice(10);
                } else {
                    $ticket->setRate(false);
                }

                $totalPrice += $ticket->getPrice();
            }

            $order->setTotalPrice($totalPrice);

            return true;
        }

        return false;
    }

}