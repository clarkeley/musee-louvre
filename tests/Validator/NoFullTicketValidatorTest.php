<?php

namespace App\Tests;

use App\Repository\OrderRepository;
use App\Validator\NoFullTicketValidator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class NoFullTicketValidatorTest extends ConstraintValidatorTestCase
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public function methodToMock()
    {
        $this->orderRepository = new OrderRepository();

        $orderRepository = $this->createMock(OrderRepository::class);
    }
    protected function createValidator()
    {
        return new NoFullTicketValidator();
    }
}
