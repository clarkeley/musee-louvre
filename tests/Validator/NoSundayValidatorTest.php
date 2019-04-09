<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 06/03/2019
 * Time: 14:25
 */

namespace App\Tests\Validator;

use App\Validator\NoSunday;
use App\Validator\NoSundayValidator;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class NoSundayValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator()
    {
        return new NoSundayValidator();
    }

    public function testValidDate()
    {
        $this->validator->validate(new \DateTime("2019-03-27"), new NoSunday());

        $this->assertNoViolation();
    }

    public function testInvalidDate()
    {
        $this->validator->validate(new \DateTime("2019-03-31"), new NoSunday());

        $constraint = new NoSunday();

        $this->buildViolation($constraint->message)->assertRaised();

    }

}