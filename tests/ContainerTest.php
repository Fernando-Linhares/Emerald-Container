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
        
        $result = $instance->implemented;
        
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function isAbleLoadClassWithClassDependencies()
    {
        $container = new Container();
        
        $instance = $container->get(ApplicationWithDependencies::class);

        $this->assertTrue($instance->implemented);
    }

    /**
     * @test
     */
    public function isAbleLoadClassWithMultiClassDependencies()
    {
        $container = new Container();

        $instance = $container->get(ApplicationWithMultiDependencies::class);

        $this->assertTrue($instance->anotherAppImplemented);

        $this->assertTrue($instance->appImplemented);
    }

    /**
     * @test
     */
    public function usableInterfaceOnContainer()
    {
        $container = new Container();

        $container->register(ApplicationInterface::class, Application::class);

        $instance = $container->get(ApplicationInterface::class);

        $this->assertTrue($instance->implemented);
    }

    /**
     * @test
     */
    public function injectionOnMethod()
    {
        $container = new Container();

        $instance = $container->get(ApplicationWithDependencies::class);

        $this->assertFalse($instance->notImplemented);
    }

    /**
     * @test
     */
    public function injectionOnMethodWithNativeParams()
    {
        $container = new Container();

        $instance = $container->get(ApplicationWithDependencies::class);

        $this->assertEquals(1, $instance->countNum(1));
    }
}