<?php

namespace Core\Routing;

use Core\Auth\AuthInterface;
use Core\Controller\Controller;
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

        $dispatch = $this->match($httpMethod, $uri);

        //dispatch = code 0 handler 1 vars 2
        switch ($dispatch[0]) {
            case Router::NOT_FOUND:
                echo 'not found';
                break;
            case Router::METHOD_NOT_ALLOWED:
                echo 'method not allowed';
                break;
            case Router::FOUND:
                $handler = $dispatch[1];
                $vars = $dispatch[2];

                if ($handler instanceof Route) {
                    return $this->runHandler($handler, $vars);
                } else {
                    return fn() => 'error 500';
                }
                break;
        }
        exit;
    }

    private function runHandler(Route $route, array $vars = [])
    {
        /** @var Route $route */
        $handler = $route->handler();
        if (is_array($handler)) {
            echo 'controller->';
            /** @var Controller $controller */
            
            $controller = new $handler[0]();
            $action = $handler[1];

            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setValidator'], $this->validator);
            call_user_func([$controller, 'setStorage'], $this->storage);
            call_user_func([$controller, 'setAuth'], $this->auth);
            call_user_func([$controller, 'setSession'], $this->session);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setDatabase'], $this->database);

            call_user_func([$controller, $action]);
        }
        if (is_callable($handler)) {    
            echo 'function->';
            print call_user_func($handler);
        }
    }

    // private function dispatch(string $httpMethod, string $uri)
    // {
    //     $match = $this->match(
    //         $this->request->method(),
    //         $this->request->uri()
    //     );

    //     return $match;
    // }

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
