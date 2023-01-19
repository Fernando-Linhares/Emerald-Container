<?php

namespace Emerald\Container\Abstraction;

use Emerald\Container\Contracts\IMonostate;

class MonostateBoard implements IMonostate
{
    public static array $board = [];

    public function contains($needle): bool
    {
        if(!empty(self::$board)){

            $keys = array_keys(self::$board);

            return in_array($needle, $keys);
        }

        return false;
    }

    public function __set($name, $value)
    {
        self::$board[$name] = $value;
    }

    public function __get($name)
    {
        return self::$board[$name];
    }
}