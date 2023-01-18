<?php 

namespace Emerald\Container\Reflection;
use ReflectionClass;

class Scanner
{
    protected string $namespace;

    protected object $instance;

    public function getParametersByConctructor($namespace): array
    {
        $reflection = new ReflectionClass($namespace);

        $parameters = $reflection->getConstructor()?->getParameters();

        if(!empty($parameters)){
            return array_map(function($parameter){
                return  $parameter->getType()->getName();
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
        return $this->instance;
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