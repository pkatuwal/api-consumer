<?php
namespace Worldlink\JWTAuth\Exceptions;

use LogicException;

class InvalidArgumentException extends LogicException
{
    protected $code=400;
    protected $message="Invalid Argument Exception";
}
