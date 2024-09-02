<?php

namespace Core\Config;

class Config implements ConfigInterface
{
    private static $configArray = [
        'app' => [
            'name' => 'Mark',
        ],
    ];

    public function getValue($key): string|array
    {
        if (!str_contains($key, '.')) {
            $result = self::$configArray[$key];
            return $result;
        }

        // $formatKey = str_replace('.', '][', $key);
        // $formatKey = "[{$formatKey}]";

        // $result = self::$configArray[$formatKey];
        // return $result;
    }

    public function setValue(string $key, string|array $value): void
    {
        self::$configArray[$key] = $value;
    }

    public function hasValue(string $key): bool
    {
        if (array_key_exists($key, self::$configArray)) {
            return true;
        }

        return false;
    }
}
