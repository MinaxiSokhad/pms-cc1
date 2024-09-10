<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\Exceptions\ValidationException;

class AuthRequiredMiddleware implements MiddlewareInterface
{
  public function process(callable $next)
  {
    if (empty($_SESSION['user'])) {

      redirectTo('/admin/login');
    }
    try {

      $next();
    } catch (ValidationException $e) {

      $_SESSION['errors'] = $e->errors;
      $refer = $_SERVER['HTTP_REFERER'];
      redirectTo($refer);
      $next();
    }
  }
}