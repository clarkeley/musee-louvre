<?php

namespace App\Tests;

use App\Validator\OffDays;
use App\Validator\OffDaysValidator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class OffDaysValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator()
    {
        return new OffDaysValidator();
    }

    public function testOffDay()
    {
        $this->validator->validate(new \DateTime("2020-01-02"), new OffDays());

        $this->assertNoViolation();
    }

    public function testWrongDay()
    {
        $this->validator->validate(new \DateTime("2020-11-11"), new OffDays());

        $this->assertFalse(false);
    }
}
