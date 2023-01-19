<?php

namespace Emerald\Container\Abstraction;

use Emerald\Container\Exceptions\{TypeNotFoundException, AttributeNotFoundInterfaceException, NotFoundException};
use Emerald\Container\Abstraction\MonostateBoard;
use Emerald\Container\Contracts\IMonostate;
use Emerald\Container\Reflection\Scanner;
use ReflectionMethod;

class InterfaceConcret
{
    private array $attrs = [];

    public function __construct(
        private object $instance,
    ){
        $this->attrs;

        foreach(get_class_methods($this->instance) as $attr){
            $this->attrs[$attr] = null;
        }

    }


    public function __get($name)
    {
        return $this->callOverBoard($name);
    }

    public function __call($name, $arguments)
    {
        return $this->callOverBoard($name, $arguments);
    }

    private function callOverBoard($name, $input=null)
    {
        $reflection = new ReflectionMethod($this->instance, $name);

        $parameters = $reflection->getParameters();
        
        $scanner = new Scanner;

        $monostate = new MonostateBind;

        if(!empty($parameters)){

            $typeNames = [];

            for($i = 0; $i < count($parameters); $i++){
                
                $parameter = $parameters[0];
                
                $type = $parameter->getType()->getName();

                if($monostate->contains($type)){
                    
                    $objectExpected = $scanner->applyRefl(array($monostate->$type));

                    $typeNames = [...$typeNames, ...$objectExpected];

                    continue;
                }
                
                if(class_exists($type)){

                    $objectExpected = $scanner->applyRefl(array($type));

                    $typeNames = [...$typeNames, ...$objectExpected];

                    continue;
                }

                $boundValue = null;

                settype($boundValue, $type);

                if(!empty($input[$i])){
                    if(gettype($input[$i]) === gettype($boundValue)){
                        
                        $typeNames[] = $input[$i];

                        continue;
                    }
                }

                throw new TypeNotFoundException($type);
            }

            return $this->instance->$name(...$typeNames);
        }

        return $this->instance->$name();
    }
}