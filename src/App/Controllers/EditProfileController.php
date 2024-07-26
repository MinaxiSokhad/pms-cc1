<?php
declare(strict_types= 1);
namespace App\Controllers;
use App\Config\Paths;


use Framework\TemplateEngine;
use App\Services\{EditProfileService,ValidatorService,UserService};
class EditProfileController{
    public function __construct(
        private TemplateEngine $view,
        private EditProfileService $profileService,
        private ValidatorService $validatorService,
        private UserService $userService,
        )
        {

        }
        public function editProfileView(){
  
            
            $editProfile = $this->profileService->getUserProfile((int) $_SESSION['user']);
            // dd($profile);
            if(!$editProfile){
                redirectTo('/');
            }
            
            echo $this->view->render("/staff/editProfile.php",[
                'editProfile' => $editProfile,
                'storage' => Paths::STORAGE_UPLOADS
                
            ]);
            
          }

//          {
//     $profile = $this->profileService->getUserProfile($_SESSION['user']);

//     if (!$profile) {
//       redirectTo("/");
//     }

//     //dd($_FILES);
//     $imageFile = $_FILES['image'] ?? null;
//     // dd($receiptFile);
//     $this->profileService->validateFile($imageFile);
    
//     $this->profileService->upload($imageFile,$profile['id']);
//      redirectTo("/");
//   }


          public function updateProfile(){
            $this->validatorService->validateProfile($_POST);
             $this->userService->isEmailTakenProfile($_POST['email']);
           //  $this->profileService->mobilenoAlreadyExists($_POST['mobileNo'],$_SESSION['user']);
            $this->profileService->updateData($_POST,$_FILES['image']);
            redirectTo($_SERVER['HTTP_REFERER']);
          
          }

}