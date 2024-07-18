<?php

declare(strict_types=1);

namespace App\Config;
use Framework\App;
use App\Controllers\{
    AuthController,
    HomeController
};


function registerRoutes(App $app) //register the route and then autoload files
{
    $app->get('/', [HomeController::class, 'home']);
    $app->get('/register', [AuthController::class,'registerView']);
    $app->post('/register', [AuthController::class, 'register']);
    $app->get('/login', [AuthController::class,'loginView']);
    $app->post('/login', [AuthController::class, 'login']);

}