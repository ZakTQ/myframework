<?php

namespace Core\Http\Request;

class Request implements RequestInterface
{
    private function __construct(
        private array $server,
        private array $get,
        private array $post,
        private array $files,
        private string $method,
        private string $uri,
        private array $cookie,
    ) {}
    public static function setGlobals(): Request
    {
        return new Request(
            $_SERVER,
            $_GET,
            $_POST,
            $_FILES,
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['REQUEST_URI'],
            $_COOKIE,
        );
    }

    public function method(): string
    {
        return $this->method;
    }

    public function input(): array
    {
        return $_POST ?? $_GET;
    }

    public function uri(): string
    {
        return $this->uri;
    }

    public function files(): array
    {
        return $this->files;
    }

    public function cookie(): array
    {
        return $this->cookie;
    }

    public function server(): array
    {
        return $this->server;
    }
}
