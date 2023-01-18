<?php

namespace Emerald\Container\Contracts;

interface IMonospace
{
    public function contains($needle): bool;
}