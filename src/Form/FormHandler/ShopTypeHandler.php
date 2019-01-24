<?php

namespace App\Form\FormHandler;

use App\Entity\Ticket;
use App\Manager\OrderManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


final class ShopTypeHandler
{
    /**
     * @var OrderManager
     */
    private $orderManager;

    public function __construct(OrderManager $orderManager)
    {
        $this->orderManager = $orderManager;
    }

    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $order = $form->getData();

            $this->orderManager->generateTickets($order);

            return true;
        }

        return false;
    }




}