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
    public $message = 'Nous sommes désolés, le nombre maximal de tickets vendus à été atteint, essayez de réserver un autre jour.';
}
