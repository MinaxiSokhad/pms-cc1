<?php
declare(strict_types= 1);
namespace App\Services;
use Framework\Database;
use Framework\Exceptions\ValidationException;
class UserService{
    public function __construct(private Database $db){}
    public function isEmailTaken(string $email)
    {
        $emailCount = $this->db->query(
            "SELECT COUNT(*) FROM users WHERE email =:email",
            ['email' => $email ] )->count();

        if($emailCount > 0){
            throw new ValidationException(['email'=>"Email Taken"]);
            
        }
    }
    public function create(array $formData){
        $password = password_hash($formData['password'],PASSWORD_BCRYPT,['cost'=>12]);
        $formattedDate = "{$formData['dob']} 00:00:00";
        $hireDate = "{$formData['hireDate']} 00:00:00";
        $this->db->query(
            "INSERT INTO user(
            name,email,password,country,state,city,gender,marital_status,mobile_no,address,date_of_birth,hire_date)
            VALUES(:name,:email,:password,:country,:state,:city,:gender,:maritalStatus,:mobileNo,:address,:dob,:hireDate)",
            [
                'name'=> $formData['name'],
                'email'=> $formData['email'],
                'password'=> $password,
                'country'=> $formData['country'],
                'state'=> $formData['state'],
                'city'=> $formData['city'],
                'gender'=> $formData['gender'],
                'maritalStatus'=> $formData['maritalStatus'],
                'mobileNo'=> $formData['mobileNo'],
                'address'=> $formData['address'],
                'dob'=> $formattedDate,
                'hireDate'=> $hireDate
            ]
            );
            session_regenerate_id();
            $_SESSION['user']=$this->db->id();
    }
}