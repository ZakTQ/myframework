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

    public function matching()
    {
        $httpMethod = $this->request->method();
        $uri = $this->request->uri();

        $dispatch = $this->dispatch($httpMethod, $uri);

        //dispatch = code 0 handler 1 vars 2
        switch ($dispatch[0]) {
            case Router::NOT_FOUND:
                echo 'not found';
                break;
            case Router::METHOD_NOT_ALLOWED:
                echo 'method not allowed';
                break;
            case Router::FOUND:
                /** @var Route $dispatch[1] */
                dump($dispatch[1]);
                dump($dispatch[2]);
                
                return call_user_func($dispatch[1]->handler());
                break;
        }
    }

    private function dispatch($httpMethod, $uri)
    {
        /** @var Request $request */
        $match = $this->match(
            $this->request->method(),
            $this->request->uri()
        );

        return $match;
    }

    private function match(string $method, string $uri)
    {
        $arrayRoutes =  require_once APP_PATH . '/routes/routes.php';
        /**
         * @var Route $route
         */
        foreach ($arrayRoutes as $route) {
            $this->routes[$route->method()][$route->uri()] = $route;
        }

        if (isset($this->routes[$method][$uri])) {
            return [Router::FOUND, $this->routes[$method][$uri], []];
        }

        return [Router::NOT_FOUND, 'not found', []];
    }
}
