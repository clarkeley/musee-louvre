<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 19/12/2018
 * Time: 22:23
 */

namespace App\Form\FormHandler;


use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Form\FormInterface;

class TicketTypeHandler
{
    public function __construct()
    {

    }

    public function handle(FormInterfaceace $form) : Boolean
    {
        if ($form->isSubmitted() && $form->isValid()) {

            return true;
        }

        return false;
    }

}