<?php

namespace Core\View;

class View implements ViewInterface
{
    private string $path = APP_PATH . '/views/';

    public function __construct() {}

    public function render(string $page)
    {
        return require_once $this->path . $page . '.php';
    }
}
