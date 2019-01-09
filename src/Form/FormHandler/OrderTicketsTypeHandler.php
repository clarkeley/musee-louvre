<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 19/12/2018
 * Time: 22:23
 */

namespace App\Form\FormHandler;



use Symfony\Component\Form\FormInterface;

class OrderTicketsTypeHandler
{

    public function handle(FormInterface $form) : bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $order = $form->getData();

           // TODO mettre à jour les prix age, date typebillet, rate



            return true;
        }

        return false;
    }

}