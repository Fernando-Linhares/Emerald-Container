<?php

namespace Emerald\Container\Abstraction;

use Emerald\Container\Contracts\IMonostate;

class MonostateBind implements IMonostate
{
    public static array $bind = [];

    public function contains($needle): bool
    {
        if(!empty(self::$bind)){

            $keys = array_keys(self::$bind);

            return in_array($needle, $keys);
        }

        return false;
    }

    public function __set($name, $value)
    {
        self::$bind[$name] = $value;
    }

    public function __get($name)
    {
        return self::$bind[$name];
    }
}