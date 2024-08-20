<?php
declare(strict_types=1);
namespace App\Controllers;

use Framework\Exceptions\ValidationException;
use Framework\TemplateEngine;
use App\Services\{ValidatorService, CustomerService, UserService};

class CustomerController
{
    public function __construct(
        private TemplateEngine $view,
        private CustomerService $customerService,
        private ValidatorService $validatorService,
        private UserService $userService
    ) {
    }
    // public function customerView(array $params = [])
    // {
    //     $page = isset($_GET['p']) ? (int) $_GET['p'] : 1;
    //     // $page = (int) $page;
    //     $limit = 3;
    //     $offset = (int) ($page - 1) * $limit;
    //     $name = explode("_", $_POST["sort"] ?? 'id_desc');

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //         if ((count($name) == 2) && ($name[1] == "asc" || $name[1] = "desc") && $_POST['s'] != '') {
    //             [$viewcustomer, $count] = $this->customerService->getCustomer(searchTerm: $_POST['s'], order_by: $name[0], direction: $name[1], limit: (int) $limit, offset: (int) $offset);

    //         }

    //         if (array_key_exists("company", $_POST)) {
    //             [$viewcustomer, $count] = $this->customerService->getCustomer($_POST['company'], $_POST['s'], $name[0], $name[1], (int) $limit, (int) $offset);

    //         }
    //         // if (array_key_exists('country', $_POST)) {
    //         //     if ($_POST['s']) {
    //         //         [$viewcustomer, $count] = array_merge($viewcustomer, $this->customerService->getCustomer($_POST['country'], $_POST['s'], $name[0], $name[1], (int) $limit, (int) $offset));
    //         //     } else {
    //         //         [$viewcustomer, $count] = $this->customerService->getCustomer($_POST['country'], '', $name[0], $name[1], (int) $limit, (int) $offset);
    //         //     }
    //         // }
    //         if ((count($name) == 2) && ($name[1] == "asc" || $name[1] = "desc") && $_POST['s'] == '') {
    //             [$viewcustomer, $count] = $this->customerService->getCustomer(order_by: $name[0], direction: $name[1], limit: (int) $limit, offset: (int) $offset);
    //         }
    //     } else {

    //         [$viewcustomer, $count] = $this->customerService->getCustomer(order_by: $name[0], direction: $name[1], limit: (int) $limit, offset: (int) $offset);
    //     }
    //     $customers = $this->customerService->getcustomers();

    //     $lastPage = ceil($count / $limit);
    //     echo $this->view->render("customer.php", [
    //         'viewcustomer' => $viewcustomer,
    //         'customers' => $customers,

    //         'currentPage' => $page,
    //         'previousPageQuery' => http_build_query([
    //             'p' => $page - 1
    //         ]),
    //         'lastPage' => $lastPage,
    //         'nextPageQuery' => http_build_query([
    //             'p' => $page + 1
    //         ]),

    //     ]);

    // }
    public function customerView(array $params = [])
    {
        // echo "<pre>";
        // print_r($_REQUEST);
        // die();
        $page = isset($_GET['p']) ? (int) $_GET['p'] : 1;
        // $page = (int) $page;
        $limit = 3;
        $offset = (int) ($page - 1) * $limit;
        $name = explode("_", $_POST["sort"] ?? 'id_desc');
        $viewcustomer = [];
        $count = 0;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($_POST['s']) {

                [$viewcustomer, $count] = $this->customerService->getCustomer(searchTerm: $_POST['s'], order_by: $name[0], direction: $name[1], limit: (int) $limit, offset: (int) $offset);
            }
            if (array_key_exists("company", $_POST)) {

                [$viewcustomer, $count] = $this->customerService->getCustomer($_POST['company'], 'company', '', $name[0], $name[1], (int) $limit, (int) $offset);

            }
            if (array_key_exists('country', $_POST)) {

                [$viewcustomer, $count] = $this->customerService->getCustomer($_POST['country'], 'country', '', $name[0], $name[1], (int) $limit, (int) $offset);


            }
            if ($_POST['s'] == '' && !array_key_exists('country', $_POST) && !array_key_exists("company", $_POST)) {

                [$viewcustomer, $count] = $this->customerService->getCustomer(order_by: $name[0], direction: $name[1], limit: (int) $limit, offset: (int) $offset);

            }

        } else {

            [$viewcustomer, $count] = $this->customerService->getCustomer(order_by: $name[0], direction: $name[1], limit: (int) $limit, offset: (int) $offset);
        }
        $customers = $this->customerService->getcustomers();

        $lastPage = ceil($count / $limit);

        echo $this->view->render("customer.php", [
            'viewcustomer' => $viewcustomer,
            'customers' => $customers,

            'currentPage' => $page,
            'previousPageQuery' => http_build_query([
                'p' => $page - 1
            ]),
            'lastPage' => $lastPage,
            'nextPageQuery' => http_build_query([
                'p' => $page + 1
            ]),

        ]);

    }

    public function customer()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            echo $this->view->render("createcustomer.php", [
                // 'createcustomer' => $createcustomer
            ]);
        } else {
            $this->validatorService->validateCustomer($_POST);
            if ($this->validatorService->isExists('customers', 'company', $_POST['company'])) {
                throw new ValidationException(['company' => ['Company name already exists']]);
            }
            if ($this->validatorService->isExists('customers', 'website', $_POST['website'])) {
                throw new ValidationException(['website' => ['Website already exists']]);
            }
            if ($this->validatorService->isExists('customers', 'email', $_POST['email'])) {
                throw new ValidationException(['email' => ['Email already exists']]);
            }
            if ($this->validatorService->isExists('customers', 'phone', $_POST['phone'])) {
                throw new ValidationException(['phone' => ['Phone number already exists']]);
            }
            $this->customerService->create($_POST);
            redirectTo('/customer');
        }
    }
    public function updateCustomer(array $params = [])
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $editcustomer = $this->customerService->getcustomers([$params['customer']]);

            if (!$editcustomer) {
                redirectTo('/');
            }

            echo $this->view->render("editcustomer.php", [
                'editcustomer' => $editcustomer
            ]);
        } else {
            $this->validatorService->validateCustomer($_POST);
            $this->customerService->update($_POST, (int) $params['customer']);
            redirectTo('/customer');
        }
    }
    public function deleteCustomer(array $id)
    {

        if ($id['customer'] === "0") {
            $this->customerService->delete($_POST['ids']);
            redirectTo('/customer');
        } else {
            $this->customerService->delete([$id['customer']]);//'customer' -> route parameter
            redirectTo('/customer');
        }


    }

}