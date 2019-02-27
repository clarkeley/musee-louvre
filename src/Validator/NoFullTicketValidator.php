<?php

namespace App\Validator;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

class NoFullTicketValidator extends ConstraintValidator
{
    const MAX_AVAILABLE_TICKETS = 1000;

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    public function validate($value, Constraint $constraint)
    {
        if(!$value instanceof Order){
            throw new \LogicException();
        }
        if(!$constraint instanceof NoFullTicket){
            throw new \LogicException();
        }

        $nbr = $value->getQuantite() + $this->orderRepository->countTicketsForDate($value->getDate());

        if ($nbr > self::MAX_AVAILABLE_TICKETS)
        {

            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
