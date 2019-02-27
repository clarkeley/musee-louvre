<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NoFullTicket extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'Nous sommes désolés, le nombre de tickets demandé dépasse le stock disponible, essayez de réduire les quantités ou de réserver un autre jour .';
}
