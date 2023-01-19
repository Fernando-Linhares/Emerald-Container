<?php

namespace Emerald\Container\Abstraction;

use Emerald\Container\Contracts\IRecover;
use Emerald\Container\Reflection\Scanner;

class Recover extends Scanner implements IRecover
{
    public function __construct(
        protected string $namespace
    ){}

    /**
     * @return mixed
     */
    public function getConcretInstance()
    {
        return $this->getInstanceByType();
    }

    /**
     * @return void
     */
    public function load(): void
    {
        $this->loadInstance();
    }
}