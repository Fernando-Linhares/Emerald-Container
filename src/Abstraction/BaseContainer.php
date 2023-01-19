<?php

namespace Emerald\Container\Abstraction;

use Emerald\Container\Contracts\{ IRecover, IMonostate, IBaseContainer };

abstract class BaseContainer implements IBaseContainer
{
    protected function __construct(
        protected IMonostate $monospace = new MonostateBind
    ){}

    public function identify(string $namespace): IRecover
    {
        if($this->monospace->contains($namespace)){
            return new Recover($this->monospace->$namespace);
        }

        return new Recover($namespace);
    }

    /**
     * Register Interfaces
     * 
     * @param string $abstract
     * @param string $concret
     * @return void
     */
    public function register(string $abstract, string $concret): void
    {
        $this->monospace->$abstract = $concret;
    }
}