<?php

namespace Emerald\Container\Exceptions;


class NotFoundException extends \Exception 
{
    public function __construct($typeName)
    {
        parent::__construct("Not found class {$typeName}.");
    }

}