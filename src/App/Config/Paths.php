<?php

declare(strict_types=1);

namespace App\Config;

class Paths
{
    public const VIEW = __DIR__ . "/../views"; //setting base path
    public const SOURCE = __DIR__ . "/../../"; //this path should point to source directory of our project
    public const ROOT = __DIR__ . "/../../../"; //this path should point to root directory
    public const STORAGE_UPLOADS = __DIR__."/../../../storage/uploads";
}
