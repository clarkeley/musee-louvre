<?php

namespace App\Tests;

use App\Repository\OrderRepository;
use App\Validator\NoFullTicketValidator;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class NoFullTicketValidatorTest extends KernelTestCase
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public function setUp()
    {
        $kernel = self::bootKernel();

        $this->orderRepository = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $registry = new Registry();
        $this->orderRepository = new OrderRepository($registry);

        $orderRepository = $this->createMock(OrderRepository::class);
    }
    protected function createValidator()
    {
        return new NoFullTicketValidator();
    }
}
