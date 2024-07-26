<?php
declare(strict_types= 1);
namespace App\Services;
use App\Config\Paths;
use Framework\Database;
use Framework\Exceptions\ValidationException;
class EditProfileService{
    public function __construct(private Database $db){

    }
    public function validateFile(?array $file)
    {
      
        if(!$file || $file['error'] !== UPLOAD_ERR_OK)
        {
            throw new ValidationException([
                'image'=>['Failed to upload file']
            ]);
            
        }
        $maxFileSizeMB = 3 * 1024 * 1024;
        // dd($file['size']);
        if($file['size'] > $maxFileSizeMB){
            
            throw new ValidationException([
                'image'=>['File upload is too large']
            ]);
               
        }
        $originalFileName = $file['name'];
        if(!preg_match('/^[A-Za-z0-9\s._-]+$/',$originalFileName)){
            throw new ValidationException([
                'image'=>['Invalid File Name']
            ]);
            
        }
        $clientMimeType = $file['type'];
        $allowedMineTypes = ['image/jpeg','image/png','application/pdf'];
        if(!in_array($clientMimeType,$allowedMineTypes)){
            throw new ValidationException([
                'image'=>['Invalid File Type']
            ]);
            
        }
        //dd($file);
    }
    // public function upload(array $file){
    //     $fileExtension = pathinfo($file['name'],PATHINFO_EXTENSION);
    //     $newFileName = bin2hex(random_bytes(16)).".".$fileExtension;
    //     $uploadPath = Paths::STORAGE_UPLOADS."/".$newFileName;
    //     if(!move_uploaded_file($file['tmp_name'],$uploadPath)){
    //         throw new ValidationException([
    //             'image'=>['Failed to upload image']
    //         ]);   
    //     }
    //     $this->db->query(
    //         "INSERT INTO user (image) 
    //         VALUES(:image)",
    //         [
                
    //             'original_filename' => $file['name'],
    //             'storage_filename' => $newFileName //,
    //             // 'media_type' => $file['type']
    //         ]
    //     );
    //   //  dd($newFileName);
    // }
    public function getUserProfile(int $id) {
        return $this->db->query(
            "SELECT * FROM user WHERE id=:id",
            [
                'id'=> $_SESSION['user']
            ]
        )->find();

        if (!isset($_SESSION['user'])) {
            die("User not found.");
        }
    }
    // public function upload(array $file,int $profile){
    //     $fileExtension = pathinfo($file['name'],PATHINFO_EXTENSION);
    //     $newFileName = bin2hex(random_bytes(16)).".".$fileExtension;
    //     $uploadPath = Paths::STORAGE_UPLOADS."/".$newFileName;
    //     if(!move_uploaded_file($file['tmp_name'],$uploadPath)){
    //         throw new ValidationException([
    //             'image'=>['Failed to upload File']
    //         ]);   
    //     }
    //     $this->db->query(
    //         "INSERT INTO user (id,image,storage_filename) 
    //         VALUES(:id,:image,:storage_filename)",
    //         [
    //             'id' => $profile,
    //             'image' => $file['name'],
    //             'storage_filename' => $newFileName
                
    //         ]
    //     );
    //   //  dd($newFileName);
    // }
    public function mobilenoAlreadyExists($mobileNo,$id){
        $mobileResult = $this->db->query(
            "SELECT count(*) FROM user WHERE mobileNo =:mobileNo and id!=:id",
            [
                'mobileNo'=> $mobileNo,
                'id'=> $id
            ])->fetchColumn();
          //  dd('hii');
            if($mobileResult > 0){
                throw new ValidationException(['mobileNo'=>'Mobile Number already exists']);
            }
            else{
                return false;
            }
    }
    public function emailAlreadyExists($email,$id){
        $emailResult = $this->db->query(
            "SELECT count(*) FROM user WHERE email =:email and id!=:id",
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
    public function updateData(array $formData,array $file){
       $userdata = $this->getUserProfile((int) $_SESSION['user']) ;

       if($file['name'] != ''){
        $fileExtension = pathinfo($file['name'],PATHINFO_EXTENSION);
        $newFileName = bin2hex(random_bytes(16)).".".$fileExtension;
        $uploadPath = Paths::STORAGE_UPLOADS."/".$newFileName; 
        if(!move_uploaded_file($file['tmp_name'],$uploadPath)){
            throw new ValidationException([
                'image'=>['Failed to upload image']
            ]);   
        }
    }
    else{
        $file['name'] = $userdata['image'];
        $newFileName = $userdata['storage_filename'];
    }
    $this->mobilenoAlreadyExists($formData['mobileNo'],$_SESSION['user']);
    $this->emailAlreadyExists($formData['email'],$_SESSION['user']);
        // dd($file);
        $formattedDate = "{$formData['dob']} 00:00:00";
        $hireDate = "{$formData['hireDate']} 00:00:00";
        $password = password_hash($formData['password'],PASSWORD_BCRYPT,['cost'=>12]);
        $this->db->query(
            "UPDATE user SET
             name=:name,email=:email,password=:password,country=:country,state=:state,city=:city,gender=:gender,maritalStatus=:maritalStatus,mobileNo=:mobileNo,address=:address,dob=:dob,hireDate=:hireDate,image=:image,storage_filename=:storage_filename  WHERE id=:id",
             [
                'name'=> $formData['name'],
                'email' => $formData['email'],
                'password'=> $password,
                'country' => $formData['country'],
                'state'=> $formData['state'],
                'city'=> $formData['city'],
                'gender'=> $formData['gender'],
                'maritalStatus'=> $formData['maritalStatus'],
                'mobileNo'=> $formData['mobileNo'],
                'address'=> $formData['address'],
                'dob'=> $formattedDate,
                'hireDate'=>$hireDate,
                'image'=> $file['name'],
                'storage_filename' => $newFileName ,
                'id'=> $_SESSION['user']

             ]
             );
             if($newFileName != $userdata['storage_filename']){
             unlink(Paths::STORAGE_UPLOADS.'/'.$userdata['storage_filename']);
             }
    }
}