<?php
declare(strict_types=1);
namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;
use App\Services\ValidatorService;

class CustomerService
{
    public function __construct(private Database $db, private ValidatorService $validatorService)
    {
    }
    public function getCustomer(array $id = [], string $searchTerm = '', string $order_by = 'id', string $direction = 'desc', int $limit = 3, int $offset = 0)
    {
        $param = [];
        if (!empty($id)) {

            $ids = [];
            foreach ($id as $i) {
                $ids[] = (string) $i;
            }
            $id = implode("','", $ids);


            $searched_query = " `company` IN (SELECT `company` FROM `customers` WHERE `company` LIKE :search)
            OR 
            `country` IN (SELECT `country` FROM `customers` WHERE `country` LIKE :search)	";

            $where = " WHERE `company` IN ('$id')";
            if ($searchTerm != '') {
                $where .= " AND  ($searched_query)";
                $param = ['search' => "%{$searchTerm}%"];
            }

            if (count($ids) >= 1) {

                // dd($where);
                $viewcustomer = $this->db->query(
                    "SELECT * FROM customers " . $where . " ORDER BY " . $order_by . " " . $direction . " LIMIT " . $limit . " OFFSET " . $offset,
                    $param

                )->findAll();

            } else {

                $viewcustomer = $this->db->query(
                    "SELECT * FROM customers " . $where . " ORDER BY " . $order_by . " " . $direction . " LIMIT " . $limit . " OFFSET " . $offset,
                    $param

                )->findAll();
            }
        } else {

            $where = "";

            $viewcustomer = ($this->db->query(
                "SELECT * FROM customers " . $where . " ORDER BY " . $order_by . " " . $direction . " LIMIT " . $limit . " OFFSET " . $offset,
                $param

            )->findAll());

        }
        $count = $this->db->query("SELECT COUNT(*) FROM customers")->count();
        return [$viewcustomer, $count];
        if (empty($id)) {
            die("Customer not found.");
        }
    }
    public function getcustomers(array $id = [])
    {
        if (!empty($id)) {
            $ids = [];
            foreach ($id as $i) {
                $ids[] = (INT) $i;
            }
            $id = implode(",", $ids);
            $where = " WHERE id IN ($id) ";
            return $this->db->query("SELECT * FROM customers" . $where)->findAll();
        } else {
            $where = "";
            return $this->db->query("SELECT * FROM customers" . $where)->findAll();
        }
    }

    public function searchSortCustomer(string $searchTerm, string $order_by = 'id', string $direction = 'desc', int $limit = 3, int $offset = 0)
    {
        // $searchTerm = addcslashes($_POST['s'] ?? '', '%_'); //search any character or special character like %
        $param = [];
        $viewcustomer = [];
        $param = ['search' => "%{$searchTerm}%"];
        // $pagination = "";
        $pagination = " LIMIT " . $limit . " OFFSET " . $offset;
        $viewcustomer = ($this->db->query(
            "SELECT * FROM customers 
             WHERE company LIKE :search OR website LIKE :search OR email LIKE :search OR phone LIKE :search OR country LIKE :search OR address LIKE :search 
             ORDER BY " . $order_by . " " . $direction . $pagination,
            $param
        )->findAll());
        $count = $this->db->query("SELECT COUNT(*) FROM customers")->count();
        return [$viewcustomer, $count];
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
        if ($this->validatorService->isExists('customers', 'company', $formData['company'], 'id !=' . $id)) {
            throw new ValidationException(['company' => ['Company name already exists']]);
        }
        if ($this->validatorService->isExists('customers', 'website', $formData['website'], 'id !=' . $id)) {
            throw new ValidationException(['website' => ['Website already exists']]);
        }
        if ($this->validatorService->isExists('customers', 'email', $formData['email'], 'id !=' . $id)) {
            throw new ValidationException(['email' => ['Email already exists']]);
        }
        if ($this->validatorService->isExists('customers', 'phone', $formData['phone'], 'id !=' . $id)) {
            throw new ValidationException(['phone' => ['Phone number already exists']]);
        }
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

}