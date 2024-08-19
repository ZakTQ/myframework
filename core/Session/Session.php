<?php

namespace Core\Session;

class Session implements SessionInterface
{
    public function __construct()
    {
        session_start();
    }
}
