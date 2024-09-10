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
    $app->get('/admin/', [HomeController::class, 'home'])->add(AuthRequiredMiddleware::class);
    $app->get('/admin/register', [AuthController::class, 'registerView'])->add(GuestOnlyMiddleware::class);
    $app->post('/admin/register', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
    $app->get('/admin/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
    $app->post('/admin/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
    $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);
    $app->get('/admin/profile/{user}', [ProfileController::class, 'profileView'])->add(AuthRequiredMiddleware::class);
    // $app->get('/member/{user}', [ProfileController::class, 'member'])->add(AuthRequiredMiddleware::class);
    $app->get('/admin/staff/editProfile/{user}', [ProfileController::class, 'updateProfile'])->add(AuthRequiredMiddleware::class);
    $app->post('/admin/staff/editProfile/{user}', [ProfileController::class, 'updateProfile'])->add(AuthRequiredMiddleware::class);
    $app->get('/admin/customers', [CustomerController::class, 'customerView'])->add(AuthRequiredMiddleware::class);
    $app->post('/admin/customers', [CustomerController::class, 'customerView'])->add(AuthRequiredMiddleware::class);
    $app->get('/admin/createcustomer', [CustomerController::class, 'customer'])->add(AuthRequiredMiddleware::class);
    $app->post('/admin/createcustomer', [CustomerController::class, 'customer'])->add(AuthRequiredMiddleware::class);
    $app->get('/admin/editcustomer/{customer}', [CustomerController::class, 'updateCustomer'])->add(AuthRequiredMiddleware::class);
    $app->post('/admin/editcustomer/{customer}', [CustomerController::class, 'updateCustomer'])->add(AuthRequiredMiddleware::class);
    $app->delete('/admin/deletecustomer/{customer}', [CustomerController::class, 'deleteCustomer'])->add(AuthRequiredMiddleware::class);
    $app->get('/admin/projects', [ProjectController::class, 'projectView'])->add(AuthRequiredMiddleware::class);
    $app->post('/admin/projects', [ProjectController::class, 'projectView'])->add(AuthRequiredMiddleware::class);
    // $app->get('/project/{sort}/{s}', [ProjectController::class, 'projectSort'])->add(AuthRequiredMiddleware::class);
    $app->get('/admin/createproject', [ProjectController::class, 'createProject'])->add(AuthRequiredMiddleware::class);
    $app->post('/admin/createproject', [ProjectController::class, 'createProject'])->add(AuthRequiredMiddleware::class);
    $app->get('/admin/editproject/{project}', [ProjectController::class, 'updateProject'])->add(AuthRequiredMiddleware::class);
    $app->post('/admin/editproject/{project}', [ProjectController::class, 'updateProject'])->add(AuthRequiredMiddleware::class);
    $app->delete('/admin/deleteproject/{project}', [ProjectController::class, 'deleteProject'])->add(AuthRequiredMiddleware::class);
    $app->get('/admin/project/{user}', [ProjectController::class, 'showProject'])->add(AuthRequiredMiddleware::class);
    $app->get('/admin/tasks', [TaskController::class, 'taskView'])->add(AuthRequiredMiddleware::class);
    $app->post('/admin/tasks', [TaskController::class, 'taskView'])->add(AuthRequiredMiddleware::class);
    $app->get('/admin/createtask', [TaskController::class, 'createTask'])->add(AuthRequiredMiddleware::class);
    $app->post('/admin/createtask', [TaskController::class, 'createTask'])->add(AuthRequiredMiddleware::class);
    $app->get('/admin/edittask/{task}', [TaskController::class, 'updateTask'])->add(AuthRequiredMiddleware::class);
    $app->post('/admin/edittask/{task}', [TaskController::class, 'updateTask'])->add(AuthRequiredMiddleware::class);
    $app->delete('/admin/deletetask/{task}', [TaskController::class, 'deleteTask'])->add(AuthRequiredMiddleware::class);
    $app->get('/admin/task/{user}', [TaskController::class, 'showTask'])->add(AuthRequiredMiddleware::class);
    $app->get('/admin/members', [AuthController::class, 'memberView'])->add(AuthRequiredMiddleware::class);
    $app->post('/admin/members', [AuthController::class, 'memberView'])->add(AuthRequiredMiddleware::class);
    $app->delete('/admin/deletemember/{member}', [AuthController::class, 'deleteMember'])->add(AuthRequiredMiddleware::class);
    $app->get('/admin/showmember/{user}', [ProfileController::class, 'member'])->add(AuthRequiredMiddleware::class);
    $app->get('/page', [ProjectController::class, 'page'])->add(AuthRequiredMiddleware::class);

    $app->setErrorHandler([ErrorController::class, 'notfound']);
}