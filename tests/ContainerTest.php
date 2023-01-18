<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Emerald\Container\Container;
use Tests\Examples\{
    Application,
    ApplicationInterface,
    ApplicationWithDependencies,
    ApplicationWithMultiDependencies
};

class ContainerTest extends TestCase
{
    /**
     * @test
     */
    public function isAbleLoadAnyClass()
    {
        $container = new Container();

        $instance = $container->get(Application::class);
        
        $this->assertTrue($instance->implemented());
    }

    /**
     * @test
     */
    public function isAbleLoadClassWithClassDependencies()
    {
        $container = new Container();
        
        $instance = $container->get(ApplicationWithDependencies::class);

        $this->assertTrue($instance->app->implemented());
    }

    /**
     * @test
     */
    public function isAbleLoadClassWithMultiClassDependencies()
    {
        $container = new Container();
        
        $instance = $container->get(ApplicationWithMultiDependencies::class);

        $this->assertTrue($instance->app->implemented());

        $this->assertTrue($instance->anotherApp->app->implemented());
    }

    /**
     * @test
     */
    public function usableInterfaceOnContainer()
    {
        $container = new Container();

        $container->register(ApplicationInterface::class, Application::class);

        $instance = $container->get(ApplicationInterface::class);

        $this->assertTrue($instance->implemented());
    }
}