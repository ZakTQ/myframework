<?php

namespace Core\Config;

/**
 * service locator
 * book oop 341
 */

class Config implements ConfigInterface
{
    private static array $config = [];
    private static ?Config $instance = null;

    public function __construct()
    {
        $this->init();
    }

    private function init(): void
    {
        self::$config = require_once Settings::$CONFIG;
    }

    public static function getInstance(): Config
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    public function getValue($key): string|array
    {
        if (!str_contains($key, '.')) {
            $result = $this->config[$key];
            return $result;
        }
    }

    public function setValue(string $key, string|array $value): void
    {
        $this->config[$key] = $value;
    }

    public function hasValue(string $key): bool
    {
        if (array_key_exists($key, $this->config[$key])) {
            return true;
        }

        return false;
    }
}
