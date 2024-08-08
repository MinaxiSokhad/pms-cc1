<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Config\Paths;

use Framework\Exceptions\ValidationException;
use Framework\TemplateEngine;
use App\Services\{EditProfileService, ValidatorService, UserService};

class EditProfileController
{
  public function __construct(
    private TemplateEngine $view,
    private EditProfileService $profileService,
    private ValidatorService $validatorService,
    private UserService $userService,
  ) {
  }

  public function updateProfile()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      $editProfile = $this->profileService->getUserProfile((int) $_SESSION['user']);
      if (!$editProfile) {
        redirectTo('/');
      }

      echo $this->view->render("/staff/editProfile.php", [
        'editProfile' => $editProfile,
        'storage' => Paths::STORAGE_UPLOADS

      ]);
    } else {
      $this->validatorService->validateProfile($_POST);
      $this->profileService->updateData($_POST, $_FILES['image'], (int) $_SESSION['user']);
      redirectTo($_SERVER['HTTP_REFERER']);
    }
  }

}