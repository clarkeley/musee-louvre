<?php

namespace App\Form\FormHandler;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\ShopType;

final class ShopTypeHandler
{

    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handle(FormInterface $form) : bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            return true;
        }

        return false;
    }
}