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
    public function getCustomer(array $name = [], string $column = "company", string $searchTerm = '', string $order_by = 'id', string $direction = 'desc', int $limit = 3, int $offset = 0)
    {
        $query = "SELECT * FROM customers";
        $where = " WHERE id > 0";
        $filter = isset($filter) ? $filter : '';
        $search = "";
        $order = " ORDER BY " . $order_by . " " . $direction . " LIMIT " . $limit . " OFFSET " . $offset;

        $param = [];
        if ($name) {
            $names = [];
            foreach ($name as $i) {
                $names[] = (string) $i;
            }
            $name = implode("','", $names);
            $filter .= " AND $column IN ('$name')";

        } else if ($searchTerm != '') {

            $search .= " AND website LIKE :search OR email LIKE :search OR phone LIKE :search  OR address LIKE :search ";
            $param = ['search' => "%{$searchTerm}%"];
        }

        $viewcustomer = $this->db->query(
            $query . $where . $filter . $search . $order,
            $param
        )->findAll();

        $count = $this->db->query("SELECT COUNT(*) FROM customers")->count();
        return [$viewcustomer, $count];
        if (empty($name)) {
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