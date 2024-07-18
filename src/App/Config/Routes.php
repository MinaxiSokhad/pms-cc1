<?php

declare(strict_types=1);

namespace App\Config;
use Framework\App;
use App\Controllers\{
    AuthController,
    HomeController
};
use App\Middleware\{AuthRequiredMiddleware,GuestOnlyMiddleware};

function registerRoutes(App $app) //register the route and then autoload files
{
    $app->get('/', [HomeController::class, 'home'])->add(AuthRequiredMiddleware::class);
    $app->get('/register', [AuthController::class,'registerView'])->add(GuestOnlyMiddleware::class);
    $app->post('/register', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
    $app->get('/login', [AuthController::class,'loginView'])->add(GuestOnlyMiddleware::class);
    $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
    $app->get('/logout',[AuthController::class,'logout'])->add(AuthRequiredMiddleware::class);

}