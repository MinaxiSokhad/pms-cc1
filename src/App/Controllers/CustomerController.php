<?php
declare(strict_types=1);
namespace App\Controllers;

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

        $searchTerm = $_GET['s'] ?? null;
        $name = explode('_', $params['customer_sort']);
        //dd($name);
        if (($name[1] == "asc" || $name[1] = "desc")) {
            $viewcustomer = $this->customerService->sortCustomer($name[0], $name[1]);
        } else if (empty($params) || $params['customer_sort'] == "AllCustomers") {
            $viewcustomer = $this->customerService->getCustomer();
        }
        if (array_key_exists("company", $_GET)) {
            $viewcustomer = $this->customerService->getCustomer($_GET['company']);
        }
        if (array_key_exists('country', $_GET)) {
            $viewcustomer = array_merge($viewcustomer, $this->customerService->getCustomer($_GET['country']));
        }
        if (isset($searchTerm)) {
            $viewcustomer = $this->customerService->getCustomerSearch();
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
    public function createCustomer()
    {

        echo $this->view->render("createcustomer.php", [
            // 'createcustomer' => $createcustomer
        ]);
    }
    public function editCustomerView(array $params = [])
    {
        $editcustomer = $this->customerService->getcreatedCustomer((int) $params["customer"]);

        if (!$editcustomer) {
            redirectTo('/');
        }

        echo $this->view->render("editcustomer.php", [
            'editcustomer' => $editcustomer
        ]);
    }
    public function customer()
    {

        $this->validatorService->validateCustomer($_POST);
        $this->userService->isCompanyTakenCustomer($_POST["company"]);
        $this->userService->isWebsiteTakenCustomer($_POST["website"]);
        $this->userService->isEmailTakenCustomer($_POST["email"]);
        $this->userService->isPhoneNoTakenCustomer($_POST["phone"]);
        $this->customerService->create($_POST);
        redirectTo('/customer');
    }
    public function updateCustomer(array $params = [])
    {
        $this->validatorService->validateCustomer($_POST);

        $this->customerService->update($_POST, (int) $params['customer']);
        redirectTo('/customer');
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