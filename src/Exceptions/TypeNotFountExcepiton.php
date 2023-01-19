<?php

namespace Emerald\Container\Exceptions;

class TypeNotFoundException extends \Exception 
{
    public function __construct($typeName)
    {
        parent::__construct("Type no found {$typeName}.");
    }
}