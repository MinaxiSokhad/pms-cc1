<?php
declare(strict_types=1);
namespace App\Services;
use App\Config\Paths;
use Framework\Database;
use Framework\Exceptions\ValidationException;
use App\Services\ValidatorService;
class ProfileService
{
    public function __construct(private Database $db, private ValidatorService $validatorService)
    {

    }

    public function getUserProfile(int $id = 0)
    {
        if (!empty($id)) {
            return $this->db->query(
                "SELECT * FROM user WHERE id=:id",
                [
                    'id' => $id
                ]
            )->find();
        } else {
            return $this->db->query("SELECT * FROM user")->findAll();
        }
        if (!isset($id)) {
            die("User not found.");
        }
    }
    // public function members(array $id = [])
    // {
    //     if (!empty($id)) {
    //         $ids = [];
    //         foreach ($id as $i) {
    //             $ids[] = (INT) $i;
    //         }
    //         $id = implode(",", $ids);
    //         $where = " WHERE id IN ($id) ";
    //         return $this->db->query("SELECT * FROM user" . $where)->findAll();
    //     } else {
    //         $where = "";
    //         return $this->db->query("SELECT * FROM user" . $where)->findAll();
    //     }
    // }
    public function validateFile(?array $file)
    {

        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            throw new ValidationException([
                'image' => ['Failed to upload file']
            ]);

        }
        $maxFileSizeMB = 3 * 1024 * 1024;
        if ($file['size'] > $maxFileSizeMB) {

            throw new ValidationException([
                'image' => ['File upload is too large']
            ]);

        }
        $originalFileName = $file['name'];
        if (!preg_match('/^[A-Za-z0-9\s._-]+$/', $originalFileName)) {
            throw new ValidationException([
                'image' => ['Invalid File Name']
            ]);

        }
        $clientMimeType = $file['type'];
        $allowedMineTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        if (!in_array($clientMimeType, $allowedMineTypes)) {
            throw new ValidationException([
                'image' => ['Invalid File Type']
            ]);

        }
    }
    public function updateData(array $formData, array $file, int $id)
    {
        $userdata = $this->getUserProfile((int) $id);

        if ($file['name'] != '') {
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newFileName = bin2hex(random_bytes(16)) . "." . $fileExtension;
            $uploadPath = Paths::STORAGE_UPLOADS . "/" . $newFileName;
            if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
                throw new ValidationException([
                    'image' => ['Failed to upload image']
                ]);
            }
        } else {
            $file['name'] = $userdata['image'];
            $newFileName = $userdata['storage_filename'];
        }
        if ($this->validatorService->isExists('user', 'email', $_POST['email'], 'id !=' . $id)) {
            throw new ValidationException(['email' => ['Email already exists']]);
        }
        if ($this->validatorService->isExists('user', 'mobileNo', $_POST['mobileNo'], 'id !=' . $id)) {
            throw new ValidationException(['mobileNo' => ['Mobile number already exists']]);
        }
        $formattedDate = "{$formData['dob']} 00:00:00";
        $hireDate = "{$formData['hireDate']} 00:00:00";
        $password = password_hash($formData['password'], PASSWORD_BCRYPT, ['cost' => 12]);
        $this->db->query(
            "UPDATE user SET
             name=:name,email=:email,password=:password,country=:country,state=:state,city=:city,gender=:gender,maritalStatus=:maritalStatus,mobileNo=:mobileNo,address=:address,dob=:dob,hireDate=:hireDate,image=:image,storage_filename=:storage_filename  WHERE id=:id",
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
                'hireDate' => $hireDate,
                'image' => $file['name'],
                'storage_filename' => $newFileName,
                'id' => $id

            ]
        );
        if ($newFileName != $userdata['storage_filename']) {
            unlink(Paths::STORAGE_UPLOADS . '/' . $userdata['storage_filename']);
        }
    }
}