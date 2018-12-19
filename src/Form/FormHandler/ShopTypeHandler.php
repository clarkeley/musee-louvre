<?php

namespace App\Form\FormHandler;

use http\Env\Response;
use Symfony\Component\Form\FormInterface;

final class ShopTypeHandler
{
    public function handle(FormInterface $form) : Response
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush();

            return new Response('Saved new order, ref: '.$order->getRefOrder());
        }

        return false;
    }


}