<?php

namespace Emerald\Container\Contracts;

interface IBaseContainer
{
    public function identify(string $namespace): IRecover;
}