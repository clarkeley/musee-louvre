<?php

namespace App\Validator;

use App\Entity\Order;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NoFullDayValidator extends ConstraintValidator
{
    public function validate($object, Constraint $constraint)
    {


        if(!$object instanceof Order){
            throw new \LogicException();
        }

        $dateCall = date("Y-m-d H:i:s"); //if format('m') == 05 && format('d') == 01

        $timeNow = new \DateTime();
        dd($timeNow);

        if ($timeNow->format('H') >= 14 && $object->getType() == "Journée")
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
