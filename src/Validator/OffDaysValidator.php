<?php

namespace App\Validator;

use App\Entity\Order;
use http\Env\Response;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class OffDaysValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$value instanceof \DateTime) {
            throw new \LogicException();
        }


        $year = $value->format('Y');

        $easterDate  = easter_date($year);
        $easterDay   = date('j', $easterDate);
        $easterMonth = date('n', $easterDate);

        $offDays = array(
            // Dates fixes
            mktime(0, 0, 0, 1,  1,  $year),  // 1er janvier
            mktime(0, 0, 0, 5,  1,  $year),  // Fête du travail
            mktime(0, 0, 0, 5,  8,  $year),  // Victoire des alliés
            mktime(0, 0, 0, 7,  14, $year),  // Fête nationale
            mktime(0, 0, 0, 8,  15, $year),  // Assomption
            mktime(0, 0, 0, 11, 1,  $year),  // Toussaint
            mktime(0, 0, 0, 11, 11, $year),  // Armistice
            mktime(0, 0, 0, 12, 25, $year),  // Noel

            // Dates variables
            mktime(0, 0, 0, $easterMonth, $easterDay + 1,  $year),
            mktime(0, 0, 0, $easterMonth, $easterDay + 39, $year),
            mktime(0, 0, 0, $easterMonth, $easterDay + 50, $year),
        );


        if (in_array($value->format('U'), $offDays))
        {
            /** @var OffDays $constraint */
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }


    }
}
