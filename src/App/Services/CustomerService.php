<?php
declare(strict_types= 1);
namespace App\Services;
use Framework\Database;
use Framework\Exceptions\ValidationException;
class CustomerService{
    public function __construct(private Database $db){}
    public function phonenoAlreadyExists($phone,$id){
        $phoneResult = $this->db->query(
            "SELECT count(*) FROM customers WHERE phone =:phone and id!=:id",
            [
                'phone'=> $phone,
                'id'=> $id
            ])->fetchColumn();
          //  dd('hii');
            if($phoneResult > 0){
                throw new ValidationException(['phone'=>'Phone Number already exists']);
            }
            else{
                return false;
            }
    }
    public function emailAlreadyExists($email,$id){
        $emailResult = $this->db->query(
            "SELECT count(*) FROM customers WHERE email =:email and id!=:id",
            [
                'email'=> $email,
                'id'=> $id
            ])->fetchColumn();
          //  dd('hii');
            if($emailResult > 0){
                throw new ValidationException(['email'=>'Email already exists']);
            }
            else{
                return false;
            }
    }
    public function companyAlreadyExists($company,$id){
        $companyResult = $this->db->query(
            "SELECT count(*) FROM customers WHERE company =:company and id!=:id",
            [
                'company'=> $company,
                'id'=> $id
            ])->fetchColumn();
          //  dd('hii');
            if($companyResult > 0){
                throw new ValidationException(['company'=>'Company already exists']);
            }
            else{
                return false;
            }
    }
    public function websiteAlreadyExists($website,$id){
        $websiteResult = $this->db->query(
            "SELECT count(*) FROM customers WHERE website =:website and id!=:id",
            [
                'website'=> $website,
                'id'=> $id
            ])->fetchColumn();
          //  dd('hii');
            if($websiteResult > 0){
                throw new ValidationException(['website'=>'Website already exists']);
            }
            else{
                return false;
            }
    }
    public function getCustomer(int $id=0){
        $params = [];
        if($id > 0){
            $where = " WHERE id=:id";
            $params["id"] = $id;
        }else{
                $where = "";
            }

        return $this->db->query(
            "SELECT * FROM customers ".$where,
            $params
        )->findAll();
        // return $this->db->query("SELECT * FROM customers WHERE id=:id",[
        //     "id"=> $id
        // ])->findAll();

        if (!isset($id)) {
            die("Customer not found.");
        }
    }
    public function getcreatedCustomer(int $id){
        return $this->db->query("SELECT * FROM customers WHERE id=:id",[
            'id'=> $id
        ])->find();

        if (!isset($id)) {
            die("Customer not found.");
        }
    }
    
    public function create(array $formData){
        // $password = password_hash($formData['password'],PASSWORD_BCRYPT);
        // $formattedDate = "{$formData['dob']} 00:00:00";
        // $hireDate = "{$formData['hireDate']} 00:00:00";
    
        $this->db->query(
            "INSERT INTO customers(
            company,website,email,phone,country,address)
            VALUES(:company,:website,:email,:phone,:country,:address)",
            [
                'company'=> $formData['company'],
                'website'=> $formData['website'],
                'email'=> $formData['email'],
                'phone'=> $formData['phone'],
                'country'=> $formData['country'],
                'address'=> $formData['address']    
            ]
            );
           
    }
    public function update(array $formData,int $id){
    $this->companyAlreadyExists($formData['company'],$id);
    $this->websiteAlreadyExists($formData['website'],$id);
    $this->emailAlreadyExists($formData['email'],$id);
    $this->phonenoAlreadyExists($formData['phone'],$id);
        $this->db->query(
            "UPDATE customers SET company=:company,website=:website,email=:email,phone=:phone,country=:country,address=:address WHERE id=:id",
            [
                'company'=> $formData['company'],
                'website'=> $formData['website'],
                'email'=> $formData['email'],
                'phone'=> $formData['phone'],
                'country'=> $formData['country'],
                'address'=> $formData['address'],
                'id'=> $id
            ]);
    }

        public function delete(int $id){

            
            $this->db->query("DELETE FROM customers WHERE id=:id", ["id"=> $id]);
        }
        public function deleteAll(int $id){
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteAll'])) {
                if (isset($_POST['ids']) && is_array($_POST['ids'])) {
                    $ids = $_POST['ids'];
                    // Prepare the SQL statement with placeholders
                    $placeholders = implode(',', array_fill(0, count($ids), '?'));
                    $sql = "DELETE FROM customers WHERE id IN ($placeholders)";
                    
            return $this->db->query($sql, ["id"=> $placeholders]);
        }
    }
}

}