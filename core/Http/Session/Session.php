<?php

namespace Core\Http\Session;

class Session
{
    public function __construct()
    {
        session_start();
    }
}
