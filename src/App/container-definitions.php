<?php
declare(strict_types=1);
use Framework\{TemplateEngine, Container, Database};
use App\Config\Paths;
use App\Services\{ValidatorService, UserService, ProfileService, EditProfileService, CustomerService, ProjectService};



return [
    TemplateEngine::class => fn() => new TemplateEngine(Paths::VIEW),
    ValidatorService::class => fn() => new ValidatorService(),
    Database::class => fn() => new Database($_ENV['DB_DRIVER'], [
        'hostname' => $_ENV['DB_HOST'],
        'port' => $_ENV['DB_PORT'],
        'dbname' => $_ENV['DB_NAME']
    ], $_ENV['DB_USER'], $_ENV['DB_PASS']),
    UserService::class => function (Container $container) {
        $db = $container->get(Database::class);
        return new UserService($db);
    },
    ProfileService::class => function (Container $container) {
        $db = $container->get(Database::class);
        return new ProfileService($db);
    },
    EditProfileService::class => function (Container $container) {
        $db = $container->get(Database::class);
        return new EditProfileService($db);
    },
    CustomerService::class => function (Container $container) {
        $db = $container->get(Database::class);
        return new CustomerService($db);
    },
    ProjectService::class => function (Container $container) {
        $db = $container->get(Database::class);
        return new ProjectService($db);
    }
];