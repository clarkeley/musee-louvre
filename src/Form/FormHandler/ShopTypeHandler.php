<?php

namespace App\Form\FormHandler;

use App\Entity\Ticket;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


final class ShopTypeHandler
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
            $order = $form->getData();


            $this->session->set('order', $order);

            for($i = 1; $i <= $order->getQuantite();  $i++){
                $order->addTicket(new Ticket());
            }

            return true;
        }

        return false;
    }


}