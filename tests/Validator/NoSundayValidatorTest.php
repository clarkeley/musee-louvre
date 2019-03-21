<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 06/03/2019
 * Time: 14:25
 */

namespace App\Tests\Validator;

use App\Validator\NoSundayValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use Symfony\Component\Validator\Tests\Validator\AbstractValidatorTest;

class NoSundayValidatorTest  extends ConstraintValidatorTestCase
{

    protected function createValidator()
    {
        $this->validator->validate($value, new NoSundayValidator());

        $this->assertNoViolation();
    }
}