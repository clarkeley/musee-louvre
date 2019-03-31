<?php

namespace App\Tests;

use App\Validator\NoTuesday;
use App\Validator\NoTuesdayValidator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class NoTuesdayValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator()
    {
        return new NoTuesdayValidator();
    }

    public function testValidDate()
    {
        $this->validator->validate(new \DateTime("2019-04-01"), new NoTuesday() );

        $this->assertNoViolation();
    }

    public function testViolation()
    {
        $this->validator->validate(new \DateTime("2019-04-02"), new NoTuesday());

        $this->assertFalse(false);
    }
}
