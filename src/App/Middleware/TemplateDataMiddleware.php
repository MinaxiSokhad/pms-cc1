<?php
declare(strict_types=1);
namespace App\Middleware;

use App\Services\{ProfileService, ProjectService, TaskService, CustomerService};
use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;

class TemplateDataMiddleware implements MiddlewareInterface
{
    public function __construct(
        private TemplateEngine $view,
        private ProfileService $profileService,
        private ProjectService $projectService,
        private TaskService $taskService,
        private CustomerService $customerService
    ) {
    }
    public function process(callable $next)
    {


        if (array_key_exists('user', $_SESSION)) {
            $profile = $this->profileService->getUserProfile((int) $_SESSION['user']);
            $this->view->addGlobal('profile', $profile);
            $user_count = $this->profileService->getUserProfile();
            $this->view->addGlobal('user_count', $user_count);
            $project_status = $this->projectService->getProjectStatus();
            $this->view->addGlobal('project_status', $project_status);
            // $task_status = $this->taskService->getTaskStatus();
            // $this->view->addGlobal('task_status', $task_status);
            $project = $this->projectService->getProject();
            $this->view->addGlobal('project', $project);
            $project_count = $this->projectService->getoneproject();
            $this->view->addGlobal('project_count', $project_count);
            $task = $this->taskService->getTask();
            $this->view->addGlobal('task', $task);
            $task_count = $this->taskService->getonetask();
            $this->view->addGlobal('task_count', $task_count);
            $customer_count = $this->customerService->getcustomers();
            $this->view->addGlobal('customer_count', $customer_count);
        }
        $this->view->addGlobal('title', 'PMS');
        $next();
    }
}