<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{
    AuthController,
    HomeController,
    ProfileController,
    EditProfileController,
    CustomerController,
    ProjectController,
    ErrorController,
    TaskController
};
use App\Middleware\{AuthRequiredMiddleware, GuestOnlyMiddleware};

function registerRoutes(App $app) //register the route and then autoload files
{
    $app->get('/', [HomeController::class, 'home'])->add(AuthRequiredMiddleware::class);
    $app->get('/register', [AuthController::class, 'registerView'])->add(GuestOnlyMiddleware::class);
    $app->post('/register', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
    $app->get('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
    $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
    $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);
    $app->get('/profile/{user}', [ProfileController::class, 'profileView'])->add(AuthRequiredMiddleware::class);
    $app->get('/staff/editProfile/{user}', [EditProfileController::class, 'updateProfile'])->add(AuthRequiredMiddleware::class);
    $app->post('/staff/editProfile/{user}', [EditProfileController::class, 'updateProfile'])->add(AuthRequiredMiddleware::class);
    $app->get('/customer', [CustomerController::class, 'customerView'])->add(AuthRequiredMiddleware::class);
    $app->post('/customer', [CustomerController::class, 'customerView'])->add(AuthRequiredMiddleware::class);
    $app->get('/createcustomer', [CustomerController::class, 'customer'])->add(AuthRequiredMiddleware::class);
    $app->post('/createcustomer', [CustomerController::class, 'customer'])->add(AuthRequiredMiddleware::class);
    $app->get('/editcustomer/{customer}', [CustomerController::class, 'updateCustomer'])->add(AuthRequiredMiddleware::class);
    $app->post('/editcustomer/{customer}', [CustomerController::class, 'updateCustomer'])->add(AuthRequiredMiddleware::class);
    $app->delete('/deletecustomer/{customer}', [CustomerController::class, 'deleteCustomer'])->add(AuthRequiredMiddleware::class);
    $app->get('/projects', [ProjectController::class, 'projectView'])->add(AuthRequiredMiddleware::class);
    $app->post('/projects', [ProjectController::class, 'projectView'])->add(AuthRequiredMiddleware::class);
    // $app->get('/project/{sort}/{s}', [ProjectController::class, 'projectSort'])->add(AuthRequiredMiddleware::class);
    $app->get('/createproject', [ProjectController::class, 'createProject'])->add(AuthRequiredMiddleware::class);
    $app->post('/createproject', [ProjectController::class, 'createProject'])->add(AuthRequiredMiddleware::class);
    $app->get('/editproject/{project}', [ProjectController::class, 'updateProject'])->add(AuthRequiredMiddleware::class);
    $app->post('/editproject/{project}', [ProjectController::class, 'updateProject'])->add(AuthRequiredMiddleware::class);
    $app->delete('/deleteproject/{project}', [ProjectController::class, 'deleteProject'])->add(AuthRequiredMiddleware::class);
    $app->get('/tasks', [TaskController::class, 'taskView'])->add(AuthRequiredMiddleware::class);
    $app->post('/tasks', [TaskController::class, 'taskView'])->add(AuthRequiredMiddleware::class);
    $app->get('/createtask', [TaskController::class, 'createTask'])->add(AuthRequiredMiddleware::class);
    $app->post('/createtask', [TaskController::class, 'createTask'])->add(AuthRequiredMiddleware::class);
    $app->get('/edittask/{task}', [TaskController::class, 'updateTask'])->add(AuthRequiredMiddleware::class);
    $app->post('/edittask/{task}', [TaskController::class, 'updateTask'])->add(AuthRequiredMiddleware::class);
    $app->delete('/deletetask/{task}', [TaskController::class, 'deleteTask'])->add(AuthRequiredMiddleware::class);

    $app->get('/page', [ProjectController::class, 'page'])->add(AuthRequiredMiddleware::class);

    $app->setErrorHandler([ErrorController::class, 'notfound']);
}