<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;

class CsrfGuardMiddleware implements MiddlewareInterface
{
  public function process(callable $next)
  {
    $requestMethod = strtoupper($_SERVER['REQUEST_METHOD']);
    $validMethod = ['POST', 'PATCH', 'DELETE'];
    if (!in_array($requestMethod, $validMethod)) {
      $next();
      return;
    }
    // dd($_SERVER['REQUEST_METHOD']);
    if ($_SERVER['REQUEST_URI'] == "/customer" || $_SERVER['REQUEST_METHOD'] == "POST") {
      $_POST['token'] = $_SESSION['token'];
    }
    // if ($_SERVER['REQUEST_URI'] == "/projects" || $_SERVER['REQUEST_METHOD'] == "POST") {
    //   $_POST['token'] = $_SESSION['token'];
    // }
    if ($_SESSION['token'] !== $_POST['token']) {
      // dd($_SERVER['REQUEST_METHOD']);
      redirectTo('/admin/');
    }
    unset($_SESSION['token']);
    $next();
  }
}