<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\Exceptions\ValidationException;
use Framework\TemplateEngine;
use App\Services\{ValidatorService, UserService};

class AuthController
{

    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private UserService $userService
    ) {

    }
    public function registerView()
    {
        echo $this->view->render("register.php"); //render the register.php file 
    }
    public function register()
    {

        $this->validatorService->validateRegister($_POST);
        if ($this->validatorService->isExists('user', 'email', $_POST['email'])) {
            throw new ValidationException(['email' => ['Email already exists']]);
        }
        if ($this->validatorService->isExists('user', 'mobileNo', $_POST['mobileNo'])) {
            throw new ValidationException(['mobileNo' => ['Mobile number already exists']]);
        }
        $this->userService->create($_POST);

        redirectTo("/");
    }
    public function loginView()
    {
        echo $this->view->render("login.php"); //render the register.php file 
    }
    public function login()
    {

        $this->validatorService->validateLogin($_POST);
        $this->userService->login($_POST);//user authentication
        redirectTo("/");
    }
    public function logout()
    {
        $this->userService->logout();
        redirectTo("/login");
    }
}