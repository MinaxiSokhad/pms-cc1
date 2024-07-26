<?php
declare(strict_types= 1);
namespace App\Controllers;
use App\Config\Paths;
use App\Services\ProfileService;
use Framework\TemplateEngine;
class HomeController{
    public function __construct( private TemplateEngine $view,private ProfileService $profileService){

    }
    public function home(){
        
       //echo $this->view->render("index.php");
   
    //    dd("hi");
    // $profile = $this->profileService->getUserProfile((int) $_SESSION['user']);
    //  dd($profile);
    // if(!$profile){
    //     redirectTo('/');
    // }
    
    echo $this->view->render("/index.php",[
        // 'profile' => $profile,
        // 'storage' => Paths::STORAGE_UPLOADS
        
    ]);
    }
}