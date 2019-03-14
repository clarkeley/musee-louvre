<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 06/03/2019
 * Time: 14:25
 */

namespace App\Tests\Validator;

use App\Validator\NoSundayValidator;
use Symfony\Component\Validator\Tests\Validator\AbstractValidatorTest;

class NoSundayValidatorTest  extends AbstractValidatorTest
{
    protected function getValidatorInstance()
    {
        return new NoSundayValidator();
    }

    protected function validate($value, $constraints = null, $groups = null)
    {
        $value = [0];
        $constraints = $this->testValidate();
    }

    protected function validateProperty($object, $propertyName, $groups = null)
    {
        // TODO: Implement validateProperty() method.
    }

    protected function validatePropertyValue($object, $propertyName, $value, $groups = null)
    {
        // TODO: Implement validatePropertyValue() method.
    }
}