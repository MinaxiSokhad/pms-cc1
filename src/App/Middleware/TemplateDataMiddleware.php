<?php
declare(strict_types= 1);
namespace App\Middleware;

use App\Services\ProfileService;
use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;
class TemplateDataMiddleware implements MiddlewareInterface{
    public function __construct(private TemplateEngine $view,private ProfileService $profileService){}
    public function process(callable $next){
        $this->view->addGlobal('title','PMS');
        
        if(array_key_exists('user',$_SESSION)){
            $profile = $this->profileService->getUserProfile((int) $_SESSION['user']);
            $this->view->addGlobal('profile',$profile);
        }
     
       
        // dd($profile);
        $next();
    }
}