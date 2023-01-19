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

    public function anotherAppImplemented()
    {
        return $this->anotherApp->implemented();
    }

    public function appImplemented()
    {
        return $this->app->implemented();
    }
}