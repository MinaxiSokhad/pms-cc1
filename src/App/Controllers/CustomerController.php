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
        if ($_SESSION['user_type'] == "A") {
            $viewcustomer = [];
            $count = 0;
            $_POST['select_limit'] = isset($_POST['select_limit']) ? $_POST['select_limit'] : 3;
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
                    if (array_key_exists("company", $_POST)) {
                        [$viewcustomer, $count] = $this->customerService->getCustomer(companyFilter: $_POST['company'], searchTerm: $_POST['s'], order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
                    }
                    if (array_key_exists("country", $_POST)) {
                        [$viewcustomer, $count] = $this->customerService->getCustomer(countryFilter: $_POST['country'], searchTerm: $_POST['s'], order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
                    } else {
                        [$viewcustomer, $count] = $this->customerService->getCustomer(searchTerm: $_POST['s'], order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
                    }
                }
                if (array_key_exists("company", $_POST)) {
                    if ($_POST['s']) {
                        [$viewcustomer, $count] = $this->customerService->getCustomer(companyFilter: $_POST['company'], searchTerm: $_POST['s'], order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
                    } else {
                        [$viewcustomer, $count] = $this->customerService->getCustomer(companyFilter: $_POST['company'], order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
                    }

                }
                if (array_key_exists("country", $_POST)) {
                    if ($_POST['s']) {
                        [$viewcustomer, $count] = $this->customerService->getCustomer(countryFilter: $_POST['country'], searchTerm: $_POST['s'], order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
                    } else {
                        [$viewcustomer, $count] = $this->customerService->getCustomer(countryFilter: $_POST['country'], order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
                    }
                }
                if ($_POST['s'] == '' && !array_key_exists('country', $_POST) && !array_key_exists("company", $_POST)) {
                    [$viewcustomer, $count] = $this->customerService->getCustomer(order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
                }

            } else {

                [$viewcustomer, $count] = $this->customerService->getCustomer(order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
            }

            $customers = $this->customerService->getcustomers();
            if ($showRecord != "1") {
                $lastPage = ceil($count / $limit);//Find total page
            }
            echo $this->view->render("/admin/customers.php", [
                'viewcustomer' => $viewcustomer,
                'customers' => $customers,
                'currentPage' => $page,
                'lastPage' => $lastPage,
                'record' => $count
            ]);

        } else {
            echo $this->view->render("errors/permission-error.php");
        }
    }

    public function customer()
    {
        if ($_SESSION['user_type'] == "A") {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                echo $this->view->render("/admin/createcustomer.php", [
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
                redirectTo('/admin/customers');
            }
        } else {
            echo $this->view->render("errors/permission-error.php");
        }
    }
    public function updateCustomer(array $params = [])
    {
        if ($_SESSION['user_type'] == "A") {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $editcustomer = $this->customerService->getcustomers([$params['customer']]);

                if (!$editcustomer) {
                    redirectTo('/admin/');
                }

                echo $this->view->render("/admin/editcustomer.php", [
                    'editcustomer' => $editcustomer
                ]);
            } else {
                $this->validatorService->validateCustomer($_POST);
                $this->customerService->update($_POST, (int) $params['customer']);
                redirectTo('/admin/customers');
            }
        } else {
            echo $this->view->render("errors/permission-error.php");
        }
    }
    public function deleteCustomer(array $id)
    {
        if ($_SESSION['user_type'] == "A") {

            if ($id['customer'] === "0") {
                $this->customerService->delete($_POST['ids']);
                redirectTo('/admin/customers');
            } else {
                $this->customerService->delete([$id['customer']]);//'customer' -> route parameter
                redirectTo('/admin/customers');
            }
        } else {
            echo $this->view->render("errors/permission-error.php");
        }

    }

}