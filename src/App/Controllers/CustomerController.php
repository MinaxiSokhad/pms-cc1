<?php
declare(strict_types= 1);
namespace App\Controllers;
use Framework\TemplateEngine;
use App\Services\{ValidatorService,CustomerService,UserService};
class CustomerController{
    public function __construct(
        private TemplateEngine $view,
        private CustomerService $customerService,
        private ValidatorService $validatorService,
        private UserService $userService){}
    public function customerView(){
        $viewcustomer = $this->customerService->getCustomer();
    
        if(!$viewcustomer){
            redirectTo('/');
        }
        
        echo $this->view->render("customer.php",[
            'viewcustomer' => $viewcustomer
        ]);
    }
    public function createCustomer(){
        // $createcustomer = $this->customerService->getCustomer();
    
        // if(!$createcustomer){
        //     redirectTo('/');
        // }
        
        echo $this->view->render("createcustomer.php",[
            // 'createcustomer' => $createcustomer
        ]);
    }
    public function editCustomerView(array $params=[]){
        $editcustomer = $this->customerService->getcreatedCustomer((int) $params["customer"]);
    
        if(!$editcustomer){
            redirectTo('/');
        }
        
        echo $this->view->render("editcustomer.php",[
            'editcustomer' => $editcustomer
        ]);
    }
    public function customer(){
        
        $this->validatorService->validateCustomer($_POST);
        $this->userService->isCompanyTakenCustomer($_POST["company"]);
        $this->userService->isWebsiteTakenCustomer($_POST["website"]);
        $this->userService->isEmailTakenCustomer($_POST["email"]);
        $this->userService->isPhoneNoTakenCustomer($_POST["phone"]);
        $this->customerService->create($_POST);
        // redirectTo($_SERVER['HTTP_REFERER']);
    
        redirectTo('/customer');
    }
    public function updateCustomer(array $params){
        $this->validatorService->validateCustomer($_POST);
        
        $this->customerService->update($_POST,(int) $params['customer']);
        redirectTo('/customer');
    }
    public function deleteCustomer(array $params){
 
      
        $this->customerService->delete((int) $params['customer']);//'customer' -> route parameter
        redirectTo('/customer');
    }
    public function deleteCustomers(array $params){
   
        $this->customerService->deleteAll((int) $params['customer']);//'customer' -> route parameter
        redirectTo('/customer');
    }
}