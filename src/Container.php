<?php

namespace Emerald\Container;

use Emerald\Container\Contracts\IContainer;
use Emerald\Container\Abstraction\BaseContainer;

class Container extends BaseContainer implements IContainer
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws INotFoundException  No entry was found for **this** identifier.
     * @throws IContainerException Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get($id)
    {
        $instance = $this->identify($id);

        $instance->load();

        return $instance->getConcretInstance();
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has($id)
    {}
}