<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NoFullTicketValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        //Récupérer le nombre de billet par jour depuis fonction Order ou faire tri dans la table en fonction de la date

        //$repository = $this->getDoctrine()->getRepository(Order::class);

        //Calcul nombre de ticket

        //ifviolation
        /* @var $constraint App\Validator\NoFullTicket */

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
