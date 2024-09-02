<?php
declare(strict_types=1);
namespace App\Middleware;

use App\Services\{ProfileService, ProjectService, TaskService};
use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;

class TemplateDataMiddleware implements MiddlewareInterface
{
    public function __construct(
        private TemplateEngine $view,
        private ProfileService $profileService,
        private ProjectService $projectService,
        private TaskService $taskService
    ) {
    }
    public function process(callable $next)
    {


        if (array_key_exists('user', $_SESSION)) {
            $profile = $this->profileService->getUserProfile((int) $_SESSION['user']);
            $this->view->addGlobal('profile', $profile);
            $project_status = $this->projectService->getProjectStatus();
            $this->view->addGlobal('project_status', $project_status);
            // $task_status = $this->taskService->getTaskStatus();
            // $this->view->addGlobal('task_status', $task_status);
        }
        $this->view->addGlobal('title', 'PMS');
        $next();
    }
}