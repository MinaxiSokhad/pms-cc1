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
    public function customerView(array $params = [])
    {


        $name = explode("_", $_POST["sort"] ?? '');
        if ((count($name) == 2) && ($name[1] == "asc" || $name[1] = "desc")) {
            $viewcustomer = $this->customerService->searchSortCustomer($name[0], $name[1]);
        } else {
            $viewcustomer = $this->customerService->getCustomer();
        }

        if (array_key_exists("company", $_POST)) {
            $viewcustomer = $this->customerService->getCustomer($_POST['company']);
        }
        if (array_key_exists('country', $_POST)) {
            $viewcustomer = array_merge($viewcustomer, $this->customerService->getCustomer($_POST['country']));
        }
        if ($_POST['s'] != '') {
            $viewcustomer = $this->customerService->searchSortCustomer();
        }
        // $viewcustomer = [];
        // $name = explode("_", $_POST["sort"] ?? '');

        // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //     if ((count($name) == 2) && ($name[1] == "asc" || $name[1] = "desc")) {
        //         $viewcustomer = $this->customerService->searchSortCustomer($_POST['s'], $name[0], $name[1]);
        //     } else {
        //         $viewcustomer = $this->customerService->getCustomer();
        //     }
        //     if ($_POST['s']) {
        //         $viewcustomer = $this->customerService->searchSortCustomer($_POST['s'], $name[0], $name[1]);
        //     }
        //     if (array_key_exists("company", $_POST)) {
        //         $viewcustomer = $this->customerService->getCustomer($_POST['company']);
        //     }
        //     if (array_key_exists("country", $_POST)) {
        //         $viewcustomer = array_merge($viewcustomer, $this->customerService->getCustomer($_POST['country']));
        //     }
        // } else {
        //     $viewcustomer = $this->customerService->getCustomer();

        // }
        $customers = $this->customerService->getCustomer();
        $country = $this->customerService->getCustomer();

        echo $this->view->render("customer.php", [
            'viewcustomer' => $viewcustomer,
            'customers' => $customers,
            'country' => $country,
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
            $editcustomer = $this->customerService->getCustomer([$params['customer']]);

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