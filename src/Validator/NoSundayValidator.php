<?php

namespace App\Validator;

use App\Entity\Order;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NoSundayValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$value instanceof \DateTime)
        {
            throw new \LogicException();
        }

        if (in_array($value->format('w'), [0]))
        {
            /* @var NoTuesday $constraint*/

            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
