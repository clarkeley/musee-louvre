<?php

namespace App\Tests;

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
        $date = "01-01-2019";

        $this->validator->validate($date, new DateTime());

        $this->assertNoViolation();
    }
}
