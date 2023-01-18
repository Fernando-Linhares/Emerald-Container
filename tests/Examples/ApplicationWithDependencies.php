<?php

namespace Tests\Examples;

class ApplicationWithDependencies
{
    public $app;
    
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
}