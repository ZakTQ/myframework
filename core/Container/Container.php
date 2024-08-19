<?php

namespace Core\Container;

use Core\Http\Request\Request;
use Core\Http\Request\RequestInterface;
use Core\Routing\Router\Router;
use Core\Routing\Router\RouterInterface;
use Core\View\View;
use Core\View\ViewInterface;

class Container
{
    public readonly RequestInterface $request;
    public readonly RouterInterface $router;
    public readonly ViewInterface $view;

    public function __construct()
    {
        $this->request = Request::setGlobals();
        $this->view = new View();
        $this->router = new Router(
            $this->request,
            $this->view,
            /**
             * session
             * auth
             * db
             * request
             * redirect
             * validator
             * view
             * 
             *  
             * config
             * 
             */
        );
    }
}
