<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 19/12/2018
 * Time: 22:23
 */

namespace App\Form\FormHandler;



class TicketTypeHandler
{

    public function handle(FormInterfaceace $form) : bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            /*try {
                $order->setRefOrder(random_int(1, 999999));
            } catch (\Exception $e) {
            }*/

            //$ticket->setOrder($this);

            return true;
        }

        return false;
    }

}