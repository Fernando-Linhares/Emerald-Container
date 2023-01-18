<?php

namespace Tests\Examples;

class ApplicationWithMultiDependencies
{
    public $app;

    public $anotherApp;
    
    public function __construct(Application $app, ApplicationWithDependencies $anotherApp)
    {
        $this->app = $app;

        $this->anotherApp = $anotherApp;
    }
}