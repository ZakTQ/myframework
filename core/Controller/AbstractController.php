<?php

namespace Core\Controller;

use Core\Auth\AuthInterface;
use Core\Database\DatabaseInterface;
use Core\Http\Redirect\RedirectInterface;
use Core\Http\Request\RequestInterface;
use Core\Session\SessionInterface;
use Core\Storage\StorageInterface;
use Core\Validator\ValidatorInterface;
use Core\View\ViewInterface;

abstract class AbstractController
{
    private RequestInterface $request;
    private ViewInterface $view;
    private ValidatorInterface $validator;
    private StorageInterface $storage;
    private AuthInterface $auth;
    private SessionInterface $session;
    private RedirectInterface $redirect;
    private DatabaseInterface $database;

    public function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
    }

    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }

    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }

    public function setStorage(StorageInterface $storage): void
    {
        $this->storage = $storage;
    }

    public function setAuth(AuthInterface $auth): void
    {
        $this->auth = $auth;
    }

    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }

    public function setRedirect(RedirectInterface $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function setDatabase(DatabaseInterface $database): void
    {
        $this->database = $database;
    }

    public function request(): RequestInterface
    {
        return $this->request;
    }

    public function view(): ViewInterface
    {
        return $this->view;
    }

    public function validator(): ValidatorInterface
    {
        return $this->validator;
    }

    public function storage(): StorageInterface
    {
        return $this->storage;
    }

    public function auth(): AuthInterface
    {
        return $this->auth;
    }

    public function session(): SessionInterface
    {
        return $this->session;
    }

    public function redirect(): RedirectInterface
    {
        return $this->redirect;
    }

    public function database(): DatabaseInterface
    {
        return $this->database;
    }
}
