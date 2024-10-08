<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;

class GuestOnlyMiddleware implements MiddlewareInterface
{
  public function process(callable $next)
  {
    if (!empty($_SESSION['user'])) {
      // !empty means user is login

      redirectTo('/admin/');
    }
    $next();
  }
}