<?php

namespace Core\Http\Request;

interface RequestInterface
{
    /**
     * get
     * post
     * server
     * cookie
     * uri
     * method
     * filrs
     */

    public static function setGlobals(): Request;

    public function method(): string;

    public function input(): array;

    public function uri(): string;

    public function files(): array;

    public function cookie(): array;

    public function server(): array;
}
