<?php
declare(strict_types=1);
namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class UserService
{
    public function __construct(private Database $db)
    {
    }
    public function isEmailTaken(string $email)
    {
        $emailCount = $this->db->query(
            "SELECT COUNT(*) FROM user WHERE email =:email",
            ['email' => $email]
        )->count();

        if ($emailCount > 0) {
            throw new ValidationException(['email' => "Email Taken"]);

        }
    }
    public function isMobileNoTaken(string $mobileNo)
    {
        $mobileNoCount = $this->db->query(
            "SELECT COUNT(*) FROM user WHERE mobileNo =:mobileNo",
            ['mobileNo' => $mobileNo]
        )->count();

        if ($mobileNoCount > 0) {
            throw new ValidationException(['mobileNo' => "Mobile Number Taken"]);

        }
    }
    public function isEmailTakenProfile(string $email)
    {
        $emailCount = $this->db->query(
            "SELECT COUNT(*) FROM user WHERE email =:email",
            ['email' => $email]
        )->count();

        $emailFind = $this->db->query(
            "SELECT * FROM user WHERE email= :email",
            ['email' => $email]
        )->find();
        if ($emailCount > 0) {
            if ($email !== $emailFind['email']) {
                throw new ValidationException(['email' => "Email Taken"]);
            }
        }
    }
    public function isEmailTakenCustomer(string $email)
    {
        $emailCount = $this->db->query(
            "SELECT COUNT(*) FROM customers WHERE email =:email",
            ['email' => $email]
        )->count();

        $emailFind = $this->db->query(
            "SELECT * FROM customers WHERE email= :email",
            ['email' => $email]
        )->find();
        if ($emailCount > 0) {
            if ($email !== $emailFind['email']) {
                throw new ValidationException(['email' => "Email Taken"]);
            }
        }
    }
    public function isPhoneNoTakenCustomer(string $phone)
    {
        $phoneNoCount = $this->db->query(
            "SELECT COUNT(*) FROM customers WHERE phone =:phone",
            ['phone' => $phone]
        )->count();

        if ($phoneNoCount > 0) {
            throw new ValidationException(['phone' => "Phone Number Taken"]);

        }
    }
    public function isCompanyTakenCustomer(string $company)
    {
        $CompanyCount = $this->db->query(
            "SELECT COUNT(*) FROM customers WHERE company =:company",
            ['company' => $company]
        )->count();

        if ($CompanyCount > 0) {
            throw new ValidationException(['company' => "Company Taken"]);

        }
    }
    public function isWebsiteTakenCustomer(string $website)
    {
        $websiteCount = $this->db->query(
            "SELECT COUNT(*) FROM customers WHERE website =:website",
            ['website' => $website]
        )->count();

        if ($websiteCount > 0) {
            throw new ValidationException(['website' => "Website Taken"]);

        }
    }
    public function isNameTakenProject(string $name)
    {
        $nameCount = $this->db->query(
            "SELECT COUNT(*) FROM project WHERE name =:name",
            ['name' => $name]
        )->count();

        if ($nameCount > 0) {
            throw new ValidationException(['name' => "Project Name Taken"]);

        }
    }
    public function create(array $formData)
    {
        $password = password_hash($formData['password'], PASSWORD_BCRYPT);
        $formattedDate = "{$formData['dob']} 00:00:00";
        $hireDate = "{$formData['hireDate']} 00:00:00";
        $this->db->query(
            "INSERT INTO user(
            name,email,password,country,state,city,gender,maritalStatus,mobileNo,address,dob,hireDate)
            VALUES(:name,:email,:password,:country,:state,:city,:gender,:maritalStatus,:mobileNo,:address,:dob,:hireDate)",
            [
                'name' => $formData['name'],
                'email' => $formData['email'],
                'password' => $password,
                'country' => $formData['country'],
                'state' => $formData['state'],
                'city' => $formData['city'],
                'gender' => $formData['gender'],
                'maritalStatus' => $formData['maritalStatus'],
                'mobileNo' => $formData['mobileNo'],
                'address' => $formData['address'],
                'dob' => $formattedDate,
                'hireDate' => $hireDate
            ]
        );
        session_regenerate_id();
        $_SESSION['user'] = $this->db->id();
    }
    public function login(array $formData)
    {
        $user = $this->db->query(
            "SELECT * FROM user WHERE email=:email",
            [
                'email' => $formData['email']
            ]
        )->find();

        $passwordMatch = password_verify(
            $formData['password'],
            $user['password'] ?? ''
        );
        if (!$user || !$passwordMatch) {
            throw new ValidationException(['password' => ['Invalid Credentials']]);
        }
        session_regenerate_id();
        $_SESSION['user'] = $user['id'];
    }
    public function logout()
    {
        // unset($_SESSION['user']);
        session_destroy();
        // session_regenerate_id();
        $params = session_get_cookie_params();
        setcookie(
            'PHPSESSID',
            '',
            time() - 3600,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }
}