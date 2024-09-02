<?php

namespace Core\Config;

interface ConfigInterface
{
    public function getValue(string $key): string|array;
    public function setValue(string $key,string|array $value): void;
    public function hasValue(string $key): bool;
}
