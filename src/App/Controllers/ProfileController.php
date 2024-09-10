<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Config\Paths;
use Framework\TemplateEngine;
use App\Services\{ProfileService, ValidatorService};
class ProfileController
{
    public function __construct(
        private TemplateEngine $view,
        private ProfileService $profileService,
        private ValidatorService $validatorService,
    ) {

    }
    public function profileView(array $params)
    {


        $profile = $this->profileService->getUserProfile((int) $params['user']);
        //dd($profile);
        if (!$profile) {
            redirectTo('/admin/');
        }

        echo $this->view->render("/admin/profile.php", [
            'profile' => $profile,
            'storage' => Paths::STORAGE_UPLOADS

        ]);

    }
    public function member(array $params)
    {
        $member = $this->profileService->getUserProfile((int) $params['user']);
        //dd($profile);
        if (!$member) {
            redirectTo('/admin/');
        }

        echo $this->view->render("/admin/showmember.php", [
            'member' => $member,
            'storage' => Paths::STORAGE_UPLOADS

        ]);

    }
    // public function member(array $params)
    // {
    //     $member = $this->profileService->members($params['user']);
    //     //dd($profile);
    //     if (!$member) {
    //         redirectTo('/');
    //     }

    //     echo $this->view->render("/profile.php", [
    //         'member' => $member,
    //         'storage' => Paths::STORAGE_UPLOADS

    //     ]);

    // }
    public function updateProfile(array $params = [])
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $editProfile = $this->profileService->getUserProfile((int) $params['user']);
            if (!$editProfile) {
                redirectTo('/admin/');
            }

            echo $this->view->render("/admin/staff/editProfile.php", [
                'editProfile' => $editProfile,
                'storage' => Paths::STORAGE_UPLOADS

            ]);
        } else {
            $this->validatorService->validateProfile($_POST);
            $this->profileService->updateData($_POST, $_FILES['image'], (int) $params['user']);
            redirectTo($_SERVER['HTTP_REFERER']);
        }
    }
}