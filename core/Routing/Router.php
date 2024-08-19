<?php

namespace Core\Routing;

use Core\Auth\AuthInterface;
use Core\Database\DatabaseInterface;
use Core\Http\Redirect\RedirectInterface;
use Core\Http\Request\RequestInterface;
use Core\Http\Response\ResponseInterface;
use Core\View\ViewInterface;
use Core\Routing\RouterInterface;
use Core\Session\SessionInterface;
use Core\Storage\StorageInterface;
use Core\Validator\ValidatorInterface;

class Router implements RouterInterface
{
    private array $routes = [];

    public function __construct(
        private RequestInterface $request,
        private ViewInterface $view,
        private ResponseInterface $response,
        private ValidatorInterface $validator,
        private StorageInterface $storage,
        private AuthInterface $auth,
        private SessionInterface $session,
        private RedirectInterface $redirect,
        private DatabaseInterface $database,
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
