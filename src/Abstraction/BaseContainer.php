<?php

namespace Emerald\Container\Abstraction;

use Emerald\Container\Contracts\{ IRecover, IMonospace, IBaseContainer };

abstract class BaseContainer implements IBaseContainer
{
    protected function __construct(
        protected IMonospace $monospace = new Monospace
    ){}

    public function identify(string $namespace): IRecover
    {
        if($this->monospace->contains($namespace)){
            return new Recover($this->monospace->$namespace);
        }

        return new Recover($namespace);
    }

    public function register($abstract, $concret)
    {
        $this->monospace->$abstract = $concret;
    }
}