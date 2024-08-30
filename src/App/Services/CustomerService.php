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
    public function getCustomer(array $companyFilter = [], array $countryFilter = [], string $searchTerm = '', string $order_by = 'id', string $direction = 'desc', int $limit = 3, int $offset = 0)
    {
        $filterCompany = isset($filterCompany) ? $filterCompany : '';
        $filterCountry = isset($filterCountry) ? $filterCountry : '';
        $search = "";
        $order = " ORDER BY " . $order_by . " " . $direction . " LIMIT " . $limit . " OFFSET " . $offset;

        $param = [];
        if ($companyFilter) {
            $comNames = [];
            foreach ($companyFilter as $i) {
                $comNames[] = (string) $i;
            }
            $companyFilterArr = implode("','", $comNames);
            $filterCompany .= " AND company IN ('$companyFilterArr') ";

        }
        if ($countryFilter) {
            $conNames = [];
            foreach ($countryFilter as $j) {
                $conNames[] = (string) $j;
            }
            $countryFilterArr = implode("','", $conNames);
            $filterCountry .= " AND country IN ('$countryFilterArr') ";

        }

        // dd($filterCountry);
        if ($searchTerm != '') {

            $search .= " AND (website LIKE :search OR email LIKE :search OR phone LIKE :search  OR address LIKE :search )";
            $param = ['search' => "%{$searchTerm}%"];
        }
        $query = "SELECT * FROM customers WHERE id > 0 " . $search . $filterCompany . $filterCountry;
        $viewcustomer = $this->db->query(
            $query,
            $param
        )->findAll();
        $recordCount = count($viewcustomer);
        $viewcustomer = $this->db->query(
            $query . $order,
            $param
        )->findAll();
        // dd($query . $order);
        // dd($filterCompany . $filterCountry);
        return [$viewcustomer, $recordCount];
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