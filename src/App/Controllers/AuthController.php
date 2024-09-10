<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\Exceptions\ValidationException;
use Framework\TemplateEngine;
use App\Services\{ValidatorService, UserService, ProfileService};

class AuthController
{

    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private UserService $userService,
        private ProfileService $profileService
    ) {

    }
    public function registerView()
    {
        echo $this->view->render(
            "/admin/register.php"

        ); //render the register.php file 
    }
    public function memberView()
    {
        if ($_SESSION['user_type'] == "A") {
            $viewmember = [];
            $count = 0;
            $_POST['select_limit'] = $_POST['select_limit'] ? $_POST['select_limit'] : 3;
            $showRecord = $_POST['select_limit'];

            if ($showRecord != "1") {
                $page = isset($_POST['p']) ? (int) $_POST['p'] : 1;
                $limit = isset($_POST['select_limit']) ? $_POST['select_limit'] : 3;
                $offset = (int) ($page - 1) * $limit;
            } else {
                $page = '';
                $limit = '';
                $offset = '';
            }
            $order_by = 'id';
            $direction = 'desc';
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if (array_key_exists('order_by', $_POST)) {
                    $order_by = $_POST['order_by'];
                    $direction = $_POST['direction'];
                }
                if ($_POST['s']) {
                    if (array_key_exists("country", $_POST)) {
                        [$viewmember, $count] = $this->userService->getUser(country: $_POST['country'], searchTerm: $_POST['s'], order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
                    } else {
                        [$viewmember, $count] = $this->userService->getUser(searchTerm: $_POST['s'], order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
                    }
                }
                if (array_key_exists("country", $_POST)) {
                    if ($_POST['s']) {
                        [$viewmember, $count] = $this->userService->getUser(country: $_POST['country'], searchTerm: $_POST['s'], order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
                    } else {
                        [$viewmember, $count] = $this->userService->getUser(country: $_POST['country'], order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
                    }
                }
                if ($_POST['s'] == '' && !array_key_exists('country', $_POST)) {
                    [$viewmember, $count] = $this->userService->getUser(order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
                }

            } else {

                [$viewmember, $count] = $this->userService->getUser(order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
            }


            if ($showRecord != "1") {
                $lastPage = ceil($count / $limit);//Find total page
            }
            echo $this->view->render(
                "/admin/members.php",
                [
                    'viewmember' => $viewmember,
                    'currentPage' => $page,
                    'lastPage' => $lastPage,
                    'record' => $count
                ]
            );
        } else {
            echo $this->view->render("errors/permission-error.php");
        }
    }
    public function deleteMember(array $id)
    {
        if ($_SESSION['user_type'] == "A") {
            if ($id['member'] === "0") {
                $this->userService->delete($_POST['ids']);
                redirectTo('/admin/members');
            } else {
                $this->userService->delete([$id['member']]);//'customer' -> route parameter
                redirectTo('/admin/members');
            }
        } else {
            echo $this->view->render("errors/permission-error.php");
        }
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
    }
    public function loginView()
    {
        echo $this->view->render(
            "/admin/login.php"
        );
    }
    public function login()
    {

        $this->validatorService->validateLogin($_POST);
        $this->userService->login($_POST);//user authentication
        // // dd($_POST);
        // if ($_POST['user_type'] == 'A') {
        //     redirectTo("/");
        // } else {
        //     redirectTo("/user");
        // }
        redirectTo("/admin/");
    }
    public function logout()
    {
        $this->userService->logout();

        redirectTo("/admin/login");
    }
}