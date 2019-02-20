<?php

namespace App\Validator;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

class NoFullTicketValidator extends ConstraintValidator
{

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

        /*$entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT t
            FROM App\Entity\Ticket t
            WHERE t.id
            ORDER BY p.price ASC'
        )->setParameter('price', $price);

        return $query->getResult();*/


        $repository = $this->getDoctrine()->getRepository(Order::class);

        $tickets = $repository->findOneBy(['order' => 'ticket']);

        if ($value->getNbrTickets())

        /* @var $constraint App\Validator\NoFullTicket */

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
