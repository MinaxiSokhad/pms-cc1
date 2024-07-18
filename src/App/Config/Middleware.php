<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Middleware\{
    TemplateDataMiddleware,
    FlashMiddleware,
    ValidationExceptionMiddleware,
    SessionMiddleware,
    CsrfTokenMiddleware,
    CsrfGuardMiddleware
};
 function registerMiddleware(App $app){
    $app->addMiddleware(CsrfGuardMiddleware::class);
    $app->addMiddleware(CsrfTokenMiddleware::class);
    $app->addMiddleware(TemplateDataMiddleware::class);
    $app->addMiddleware(FlashMiddleware::class);
    $app->addMiddleware(ValidationExceptionMiddleware::class);
    $app->addMiddleware(SessionMiddleware::class);
}