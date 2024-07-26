<?php
declare(strict_types= 1);
namespace App\Controllers;
use App\Config\Paths;
use Framework\TemplateEngine;
use App\Services\ProfileService;
class ProfileController{
    public function __construct(
        private TemplateEngine $view,
        private ProfileService $profileService)
        {

        }
        public function profileView(array $params){
  
            
            $profile = $this->profileService->getUserProfile((int) $params['user']);
            // dd($profile);
            if(!$profile){
                redirectTo('/');
            }
            
            echo $this->view->render("/profile.php",[
                'profile' => $profile,
                'storage' => Paths::STORAGE_UPLOADS
                
            ]);
            
          }
}