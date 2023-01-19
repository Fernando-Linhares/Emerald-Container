<?php 

namespace Emerald\Container\Reflection;

use ReflectionClass;
use Emerald\Container\Abstraction\InterfaceConcret;
use Emerald\Container\Abstraction\MonostateBind;
use ReflectionMethod;

class Scanner
{
    protected string $namespace;

    protected object $instance;

    public function getParametersByConctructor($namespace): array
    {
        $reflection = new ReflectionClass($namespace);

        $parameters = $reflection->getConstructor()?->getParameters();

        $monostate = new MonostateBind();

        if(!empty($parameters)){
            return array_map(function($parameter) use ($monostate): string
            {
                $type = $parameter->getType()->getName();

                // if($monostate->contains($type)){
                //     return $monostate->$type;
                // }
                
                return $type;

            }, $parameters);
        }

        return [];
    }

    public function loadInstance(): void
    {
        $namespace = $this->namespace;

        $listParameters = $this->getParametersByConctructor($namespace);

        $reflection = new ReflectionClass($namespace);

        if(!empty($listParameters))
            $this->instance = $reflection->newInstanceArgs($this->applyRefl($listParameters));
        else
            $this->instance = $reflection->newInstance();
    }

    /**
     * @return mixed
     */
    public function getInstanceByType(): mixed
    {
        return new InterfaceConcret($this->instance);
    }

    /**
     * @param array $params
     * @return ?array
     */
    public function applyRefl(array $params): ?array
    {
        if(!empty($params)){

            return array_map(function($namespace){
    
                $listNamespaces = $this->getParametersByConctructor($namespace);

                $reflection = new ReflectionClass($namespace);

                if(empty($listNamespaces))
                    return $reflection->newInstance();
                    
                $staticInstance = clone $this;

                $listObjects = $staticInstance->applyRefl($listNamespaces);

                return $reflection->newInstanceArgs($listObjects);
    
            }, $params);
        }
    }
}