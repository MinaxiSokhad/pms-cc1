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
        $user_type = "SELECT user_type FROM user WHERE id =:id";
        $_SESSION['user_type'] = $this->db->query($user_type, ['id' => $_SESSION['user']])->find();

    }
    public function getUser(array $country = [], string $searchTerm = '', string $order_by = 'id', string $direction = 'desc', int $limit = 3, int $offset = 0)
    {
        $viewmember = [];
        $recordCount = 0;
        $filter = isset($filter) ? $filter : '';
        $search = isset($search) ? $search : '';
        $order = "ORDER BY " . $order_by . " " . $direction;
        $param = [];
        if ($limit != 0) {
            $limit_offset = " LIMIT " . $limit . " OFFSET " . $offset;
        } else {
            $limit_offset = '';
        }

        if (!empty($country)) {
            $ids = [];
            foreach ($country as $i) {
                $ids[] = (string) $i;
            }
            $country = implode("','", $ids);
            $filter .= " AND `user`.`country` IN ('$country') ";
        }
        if ($searchTerm != '') {

            $search .= " AND (name LIKE :search
             OR email LIKE :search
             OR country LIKE :search
             OR state LIKE :search
             OR city LIKE :search
             OR gender LIKE :search
             OR maritalStatus LIKE :search
             OR address LIKE :search
             OR mobileNo LIKE :search 
             OR address LIKE :search )";
            $param = ['search' => "%{$searchTerm}%"];
        }
        $query = "SELECT * FROM user WHERE id > 0 " . $search . $filter;
        $viewmember = $this->db->query(
            $query,
            $param
        )->findAll();
        $recordCount = count($viewmember);
        $viewmember = $this->db->query(
            $query . $order . $limit_offset,
            $param
        )->findAll();
        return [$viewmember, $recordCount];
        if (empty($name)) {
            die("Member not found.");
        }
    }
    public function delete(array $id)
    {
        $ids = implode(",", $id);
        $sql = "DELETE FROM user WHERE id IN ('$ids')";
        return $this->db->query($sql);

    }
    public function login(array $formData)
    {
        $user = $this->db->query(
            "SELECT * FROM user WHERE email=:email",
            [
                'email' => $formData['email'],

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
        $_SESSION['user_type'] = $user['user_type'];
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