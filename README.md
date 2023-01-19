# Emerald Container

### Overview

Container to create dependency injection to applications. Simple Api to be used in php language, using reflection operations. Provide support to routers and more applications.

### Examples


Is Able Load Any Class
        
        $container = new Container();

        $instance = $container->get(Application::class);
        
        $result = $instance->implemented;
        //true


Is Able Load Class With Class Dependencies
        $container = new Container();
        
        $instance = $container->get(ApplicationWithDependencies::class);

        $instance->implemented;
        //true

Is Able Load Class With Multi Class Dependencies

        $container = new Container();

        $instance = $container->get(ApplicationWithMultiDependencies::class);

        $instance->anotherAppImplemented;
        //true

        $instance->appImplemented;
        //true

Usable Interface On Container
        $container = new Container();

        $container->register(ApplicationInterface::class, Application::class);

        $instance = $container->get(ApplicationInterface::class);

        echo $instance->implemented;
        // true  

Injection On Method

        $container = new Container();

        $instance = $container->get(ApplicationWithDependencies::class);

        echo $instance->notImplemented;
        // false

Injection On Method With Native Params

        $container = new Container();

        $instance = $container->get(ApplicationWithDependencies::class);

        echo $instance->countNum(1);
        // 1