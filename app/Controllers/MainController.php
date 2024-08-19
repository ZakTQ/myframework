<?php

namespace App\Controllers;

use Core\Controller\Controller;

class MainController extends Controller
{
    public function index()
    {
        return $this->view()->render('main');
    }
}
