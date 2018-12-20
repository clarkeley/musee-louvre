<?php

namespace App\Form\FormHandler;

use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
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
            /*$order = $form->getData();

            $order->getQuantite();
            //TODOmettre autant de ticket vide que demandé dans la collection tickets de l'order


            $this->session->set('order', $order);*/

            $this->session->set('order', $form->getData());
            return true;
        }

        return false;
    }


}