<?php

declare(strict_types=1);

namespace App\Config;
use Framework\App;
use App\Controllers\{
    AuthController,
    HomeController,
    ProfileController,
    EditProfileController,
    CustomerController
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
    $app->get('/profile/{user}',[ProfileController::class,'profileView'])->add(AuthRequiredMiddleware::class);
    $app->get('/staff/editProfile/{user}',[EditProfileController::class,'editProfileView'])->add(AuthRequiredMiddleware::class);
    $app->post('/staff/editProfile/{user}',[EditProfileController::class,'updateProfile'])->add(AuthRequiredMiddleware::class);
    $app->get('/customer', [CustomerController::class,'customerView'])->add(AuthRequiredMiddleware::class);
    $app->get('/createcustomer', [CustomerController::class,'createCustomer'])->add(AuthRequiredMiddleware::class);
    $app->post('/createcustomer', [CustomerController::class,'customer'])->add(AuthRequiredMiddleware::class);
    $app->get('/editcustomer/{customer}', [CustomerController::class,'editCustomerView'])->add(AuthRequiredMiddleware::class);
    $app->post('/editcustomer/{customer}', [CustomerController::class,'updateCustomer'])->add(AuthRequiredMiddleware::class);
    $app->delete('/deletecustomer/{customer}', [CustomerController::class,'deleteCustomer'])->add(AuthRequiredMiddleware::class);
    $app->delete('/deletecustomers', [CustomerController::class,'deleteCustomers'])->add(AuthRequiredMiddleware::class);

}