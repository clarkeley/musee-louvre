<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 12/02/2019
 * Time: 22:41
 */

namespace App\Validator\Constraints;

use App\Entity\Order;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

class NombreTicketValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        //Récupérer le nombre de billet par jour depuis fonction Order ou faire tri dans la table en fonction de la date

        //$repository = $this->getDoctrine()->getRepository(Order::class);

        //Calcul nombre de ticket

        //ifviolation
    }
}