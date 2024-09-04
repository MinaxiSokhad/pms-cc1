<?php
declare(strict_types=1);
namespace App\Services;
use App\Config\Paths;
use Framework\Database;
use Framework\Exceptions\ValidationException;
class ProfileService
{
    public function __construct(private Database $db)
    {

    }

    public function getUserProfile(int $id = 0)
    {
        if (!empty($id)) {
            return $this->db->query(
                "SELECT * FROM user WHERE id=:id",
                [
                    'id' => $_SESSION['user']
                ]
            )->find();
        } else {
            return $this->db->query("SELECT * FROM user")->findAll();
        }
        if (!isset($_SESSION['user'])) {
            die("User not found.");
        }
    }
}