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



}