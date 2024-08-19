<?php

namespace Core;

use Core\Container\Container;

class App extends Container
{
    public function run()
    {
        print $this->router->dispatch();
    }
}
