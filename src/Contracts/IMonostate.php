<?php

namespace Emerald\Container\Contracts;

interface IMonostate
{
    public function contains($needle): bool;
}