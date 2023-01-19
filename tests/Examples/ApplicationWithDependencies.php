<?php

namespace Tests\Examples;

class ApplicationWithDependencies
{
    public $app;
    
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function implemented()
    {
        return $this->app->implemented();
    }

    public function notImplemented(Application $app)
    {
        return !$app->implemented();
    }

    public function countNum(int $num){
        return $num;
    }
}