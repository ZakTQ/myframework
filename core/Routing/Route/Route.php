<?php

namespace Core\Routing\Route;

class Route
{
    private function __construct(
        private string $method,
        private string $uri,
        private mixed $handler,
    ) {}

    public static function get(string $uri, mixed $handler): static
    {
        return new static('GET', $uri, $handler);
    }

    public static function post(string $uri, mixed $handler): static
    {
        return new static('POST', $uri, $handler);
    }

    public function method(): string
    {
        return $this->method;
    }

    public function uri(): string
    {
        return $this->uri;
    }

    public function handler(): mixed
    {
        return $this->handler;
    }

    // public function match(string ): bool
    // {
    //     return true;
    // }
}
