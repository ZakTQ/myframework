<?php

namespace Core\Routing;

class Route
{
    private function __construct(
        private string $method,
        private string $uri,
        private mixed $handler,
        private array $middlewares,
    ) {}

    public static function get(string $uri, mixed $handler, array $middlewares = []): static
    {
        return new static('GET', $uri, $handler, $middlewares);
    }

    public static function post(string $uri, mixed $handler, array $middlewares = []): static
    {
        return new static('POST', $uri, $handler, $middlewares);
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

    public function hasMiddlewares(): bool
    {
        if (count($this->middlewares) > 0) {
            return true;
        }

        return false;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    // public function match(string ): bool
    // {
    //     return true;
    // }
}
