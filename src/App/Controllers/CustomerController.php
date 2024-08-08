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

        $searchTerm = $_GET['s'] ?? '';
        // $name = explode("_", $params["csort"]);
        $name = explode("_", $params["csort"]);
        if (empty($params) || $params['csort'] == "AllCustomers") {
            $viewcustomer = $this->customerService->getCustomer();
        } else if ((count($name) == 2) && ($name[1] == "asc" || $name[1] = "desc")) {
            $viewcustomer = $this->customerService->searchSortCustomer($name[0], $name[1]);
        }

        if (array_key_exists("company", $_GET)) {
            $viewcustomer = $this->customerService->getCustomer($_GET['company']);
        }
        if (array_key_exists('country', $_GET)) {
            $viewcustomer = array_merge($viewcustomer, $this->customerService->getCustomer($_GET['country']));
        }
        if ($searchTerm != '') {
            $viewcustomer = $this->customerService->searchSortCustomer();
        }

        $customers = $this->customerService->getCustomer();
        $country = $this->customerService->getCustomer();
        echo $this->view->render("customer.php", [
            'viewcustomer' => $viewcustomer,
            'customers' => $customers,
            'country' => $country,
            'searchTerm' => $searchTerm


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
            redirectTo('/customer/AllCustomers');
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
            redirectTo('/customer/AllCustomers');
        }
    }
    public function deleteCustomer(array $id)
    {

        if ($id['customer'] === "0") {
            $this->customerService->delete($_POST['ids']);
            redirectTo('/customer/AllCustomers');
        } else {
            $this->customerService->delete([$id['customer']]);//'customer' -> route parameter
            redirectTo('/customer/AllCustomers');
        }


    }

}