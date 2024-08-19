<?php

namespace Core\Routing\Router;

use Core\Routing\Route\Route;

interface RouterInterface
{
    //return Response
    public function dispatch();

    // public function addRoute(Route $route): Route;
}
