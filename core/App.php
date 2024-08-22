<?php

namespace Core;

use Core\Container\Container;

class App
{
    private static $instance;
    private Container $container;

    private function __construct()
    {
        $this->container = new Container();
    }

    public static function getInstance(): static
    {
        if (empty(self::$instance)) {
            self::$instance = new App();
        }
        return self::$instance;
    }

    public function run()
    {
        print $this->container->router->matching();
    }
}
