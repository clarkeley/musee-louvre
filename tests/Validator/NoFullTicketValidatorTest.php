<?php

namespace App\Tests;

use App\Entity\Order;
use App\Entity\Ticket;
use App\Repository\OrderRepository;
use App\Validator\NoFullTicket;
use App\Validator\NoFullTicketValidator;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class NoFullTicketValidatorTest extends ConstraintValidatorTestCase
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    protected function createValidator()
    {
        $this->orderRepository = $this->createMock(OrderRepository::class);
        $this->orderRepository->method("countTicketsForDate")->willReturn(900);

        return new NoFullTicketValidator($this->orderRepository);
    }

    public function testFullTicket()
    {
        $order = new Order();

        $order->setDate(new \DateTime('2019-03-20'))
            ->setQuantite(1001);

        $this->validator->validate($order, new NoFullTicket());

        $constraint = new NoFullTicket();

        $this->buildViolation($constraint->message)->assertRaised();
    }
    public function testAvailableTicket()
    {
        $order = new Order();

        $order->setDate(new \DateTime('2019-03-20'))
            ->setQuantite(100);

        $this->validator->validate($order, new NoFullTicket());

        $this->assertNoViolation();
    }
}
