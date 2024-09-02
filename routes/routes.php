<?php

use App\Controllers\MainController;
use Core\Routing\Route;

return [
    Route::get('/', [MainController::class, 'index']),
];
