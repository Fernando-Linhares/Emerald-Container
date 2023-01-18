<?php

namespace Emerald\Container\Contracts;

interface IRecover
{
    /**
     * @return mixed
     */
    public function getConcretInstance();

    public function load(): void;
}