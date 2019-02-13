<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NoFullDay extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'Vous ne pouvez pas réserver un billet pour une journée entière passer les 14h00';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
