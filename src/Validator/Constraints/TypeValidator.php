<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @property mixed context
 * @Annotation
 * @method addFlash(string $string, string $string1)
 */
class TypeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $dateCall = date("Y-m-d H:i:s"); //if format('m') == 05 && format('d') == 01

        $timeNow = date("H:i:s");

        if ($timeNow >= 140000 && $value == "Journée")
        {
            return $this->addFlash('danger', 'Il n\'est pas possible de réserver un billet \'Journée\' passer les 14h00.');
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $value, $matches)) {
            $this->context->buildViolation("Il n'est pas possible de réserver un billet 'Journée' passer les 14h00.")
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}