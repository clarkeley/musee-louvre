<?php
/**
 * Created by PhpStorm.
 * User: Clark
 * Date: 14/03/2019
 * Time: 13:38
 */

namespace App\Exception;


class NoCurrentOrderException extends \Exception
{
        protected $message = "No order in session";
}