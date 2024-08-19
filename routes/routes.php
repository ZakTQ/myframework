<?php

use App\Controllers\MainController;
use Core\Routing\Route;

return [
    Route::get('/', fn() => 'hello world'),
    Route::get('/gg', [MainController::class, 'index']),
];
