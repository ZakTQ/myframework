<?php

namespace Core\Routing\Router;

use Core\Http\Request\RequestInterface;
use Core\Routing\Route\Route;
use Core\View\ViewInterface;

class Router implements RouterInterface
{
    private array $routes = [];

    public function __construct(
        private RequestInterface $request,
        private ViewInterface $view,
    ) {}


    public function dispatch()
    {
        /** @var Request $request */
        $match = $this->match(
            $this->request->method(),
            $this->request->uri()
        );

        //dd($match);

        /** @var Route $match */
        return call_user_func($match->handler());
    }

    private function match(string $method, string $uri): ?Route
    {
        $arrayRoutes =  require_once APP_PATH . '/routes/routes.php';
        /**
         * @var Route $route
         */
        foreach ($arrayRoutes as $route) {
            $this->routes[$route->method()][$route->uri()] = $route;
        }

        return $this->routes[$method][$uri];
    }
}
