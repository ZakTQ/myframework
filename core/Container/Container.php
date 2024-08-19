<?php

namespace Core\Container;

use Core\Auth\Auth;
use Core\Auth\AuthInterface;
use Core\Config\Config;
use Core\Config\ConfigInterface;
use Core\Database\Database;
use Core\Database\DatabaseInterface;
use Core\Http\Redirect\Redirect;
use Core\Http\Redirect\RedirectInterface;
use Core\Http\Request\Request;
use Core\Http\Request\RequestInterface;
use Core\Http\Response\Response;
use Core\Http\Response\ResponseInterface;
use Core\Routing\Router;
use Core\Routing\RouterInterface;
use Core\Session\Session;
use Core\Session\SessionInterface;
use Core\Storage\Storage;
use Core\Storage\StorageInterface;
use Core\Validator\Validator;
use Core\Validator\ValidatorInterface;
use Core\View\View;
use Core\View\ViewInterface;

class Container
{
    public readonly ConfigInterface $config;
    public readonly DatabaseInterface $database;
    public readonly RedirectInterface $redirect;
    public readonly SessionInterface $session;
    public readonly AuthInterface $auth;
    public readonly StorageInterface $storage;
    public readonly ValidatorInterface $validator;
    public readonly ResponseInterface $response;
    public readonly ViewInterface $view;
    public readonly RequestInterface $request;
    public readonly RouterInterface $router;

    public function __construct()
    {
        $this->config = new Config();
        $this->database = new Database();
        $this->redirect = new Redirect();
        $this->session = new Session();
        $this->auth = new Auth();
        $this->storage = new Storage();
        $this->validator = new Validator();
        $this->response = new Response();
        $this->view = new View();
        $this->request = Request::setGlobals();
        $this->router = new Router(
            $this->request,
            $this->view,
            $this->response,
            $this->validator,
            $this->storage,
            $this->auth,
            $this->session,
            $this->redirect,
            $this->database,
        );
    }
}
