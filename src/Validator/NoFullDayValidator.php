<?php

namespace App\Validator;

use App\Entity\Order;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NoFullDayValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if(!$value instanceof Order){
            throw new \LogicException();
        }

        $timeNow = new \DateTime();

        if ($timeNow->format('H') >= 14 && $value->getType() == "Journée")
        {
            if ($value->getDate()->format('Y-m-d') == $timeNow->format('Y-m-d'))
            {
                /** @var NoFullDay $constraint */
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }
        }
    }
}
