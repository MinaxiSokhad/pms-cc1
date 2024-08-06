<?php
declare(strict_types=1);
namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class CustomerService
{
    public function __construct(private Database $db)
    {
    }
    public function phonenoAlreadyExists($phone, $id)
    {
        $phoneResult = $this->db->query(
            "SELECT count(*) FROM customers WHERE phone =:phone and id!=:id",
            [
                'phone' => $phone,
                'id' => $id
            ]
        )->fetchColumn();

        if ($phoneResult > 0) {
            throw new ValidationException(['phone' => 'Phone Number already exists']);
        } else {
            return false;
        }
    }
    public function emailAlreadyExists($email, $id)
    {
        $emailResult = $this->db->query(
            "SELECT count(*) FROM customers WHERE email =:email and id!=:id",
            [
                'email' => $email,
                'id' => $id
            ]
        )->fetchColumn();

        if ($emailResult > 0) {
            throw new ValidationException(['email' => 'Email already exists']);
        } else {
            return false;
        }
    }
    public function companyAlreadyExists($company, $id)
    {
        $companyResult = $this->db->query(
            "SELECT count(*) FROM customers WHERE company =:company and id!=:id",
            [
                'company' => $company,
                'id' => $id
            ]
        )->fetchColumn();

        if ($companyResult > 0) {
            throw new ValidationException(['company' => ['Company already exists']]);
        } else {
            return false;
        }
    }
    public function websiteAlreadyExists($website, $id)
    {
        $websiteResult = $this->db->query(
            "SELECT count(*) FROM customers WHERE website =:website and id!=:id",
            [
                'website' => $website,
                'id' => $id
            ]
        )->fetchColumn();

        if ($websiteResult > 0) {
            throw new ValidationException(['website' => 'Website already exists']);
        } else {
            return false;
        }
    }
    public function getCustomer(array $id = [])
    {


        if (!empty($id)) {
            $ids = [];
            foreach ($id as $i) {
                $ids[] = (int) $i;
            }
            $id = implode(',', $ids);
            $where = " WHERE id IN ($id)";

        } else {
            $where = "";
        }

        return $this->db->query(
            "SELECT * FROM customers " . $where

        )->findAll();


        if (!isset($id)) {
            die("Customer not found.");
        }
    }
    public function getcreatedCustomer(int $id)
    {
        return $this->db->query("SELECT * FROM customers WHERE id=:id", [
            'id' => $id
        ])->find();

        if (!isset($id)) {
            die("Customer not found.");
        }
    }
    public function getCustomerSearch()
    {
        $searchTerm = addcslashes($_GET['s'] ?? '', '%_'); //search any character or special character like %
        $param = [

            'company' => "%{$searchTerm}%"

        ];
        return $this->db->query(
            "SELECT * FROM customers WHERE company LIKE :company OR website LIKE :company OR email LIKE :company OR phone LIKE :company OR country LIKE :company OR address LIKE :company ",
            $param
        )->findAll();
    }
    public function sortCustomer(string $order_by = "id", string $direction = "asc")
    {
        if ($order_by == "company") {
            $order_by = " ORDER BY company " . $direction;
        } else if ($order_by == "website") {
            $order_by = " ORDER BY website " . $direction;
        } else if ($order_by == "email") {
            $order_by = " ORDER BY email " . $direction;
        } else if ($order_by == "phone") {
            $order_by = " ORDER BY phone " . $direction;
        } else if ($order_by == "country") {
            $order_by = " ORDER BY country " . $direction;
        } else if ($order_by == "address") {
            $order_by = " ORDER BY address " . $direction;
        } else {
            $order_by = " ORDER BY id ASC";
        }
        return $this->db->query(
            "SELECT * FROM customers " . $order_by
        )->findAll();
    }
    public function create(array $formData)
    {

        $this->db->query(
            "INSERT INTO customers(
            company,website,email,phone,country,address)
            VALUES(:company,:website,:email,:phone,:country,:address)",
            [
                'company' => $formData['company'],
                'website' => $formData['website'],
                'email' => $formData['email'],
                'phone' => $formData['phone'],
                'country' => $formData['country'],
                'address' => $formData['address']
            ]
        );

    }
    public function update(array $formData, int $id)
    {
        $this->companyAlreadyExists($formData['company'], $id);
        $this->websiteAlreadyExists($formData['website'], $id);
        $this->emailAlreadyExists($formData['email'], $id);
        $this->phonenoAlreadyExists($formData['phone'], $id);
        $this->db->query(
            "UPDATE customers SET company=:company,website=:website,email=:email,phone=:phone,country=:country,address=:address WHERE id=:id",
            [
                'company' => $formData['company'],
                'website' => $formData['website'],
                'email' => $formData['email'],
                'phone' => $formData['phone'],
                'country' => $formData['country'],
                'address' => $formData['address'],
                'id' => $id
            ]
        );
    }

    public function delete(array $id)
    {

        $placeholders = implode(',', array_fill(0, count($id), '?'));
        $sql = "DELETE FROM customers WHERE id IN ($placeholders)";
        return $this->db->query($sql, $id);

    }

    public function showCustomer(int $id)
    {
        dd($this->db->query(
            "SELECT * FROM customer WHERE id=:id ",
            [
                "id" => $id
            ]
        )->findAll());
    }


}