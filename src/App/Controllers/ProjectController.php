<?php
declare(strict_types=1);
namespace App\Controllers;

use Framework\Exceptions\ValidationException;
use App\Config\Paths;
use Framework\TemplateEngine;
use App\Services\{CustomerService, ProjectService, ValidatorService, UserService};

class ProjectController
{
    public function __construct(
        private TemplateEngine $view,
        private CustomerService $customerService,
        private ProjectService $projectService,
        private ValidatorService $validatorService,
        private UserService $userService
    ) {
    }
    public function project()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $viewcustomer = $this->customerService->getCustomer();
            $users = $this->projectService->getUser();
            $viewtags = $this->projectService->getTags();
            echo $this->view->render("createproject.php", [
                "viewcustomer" => $viewcustomer,
                "users" => $users,
                'tags' => $viewtags
            ]);
        } else {
            $this->validatorService->validateProject($_POST);
            if ($this->validatorService->isExists('project', 'name', $_POST['name'])) {
                throw new ValidationException(['name' => ['Project Name Already Exists']]);
            }
            $this->projectService->create($_POST);
            redirectTo('/projects/AllProjects');
        }
    }
    public function projectView(array $params = [])
    {


        $searchTerm = $_GET['s'] ?? null;

        $name = explode("_", $params["status"]);

        if (empty($params) || $params['status'] == "AllProjects") {

            $viewproject = $this->projectService->getProject();
        } else if (count($name) == 2 && ($name[1] == "asc" || $name[1] = "desc")) {

            $viewproject = $this->projectService->sort($name[0], $name[1]);
        } else {

            $viewproject = $this->projectService->show($params['status']);

        }
        if (isset($searchTerm)) {
            $viewproject = $this->projectService->sort();
        }


        echo $this->view->render("projects.php", [
            'viewproject' => $viewproject,
            'searchTerm' => $searchTerm,
            'oldFormData' => $params['status'] ?? []

        ]);
    }
    public function updateProject(array $params = [])
    {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $editproject = $this->projectService->getProject([$params["project"]]);
            $viewcustomer = $this->customerService->getCustomer();
            $users = $this->projectService->getUser();
            $viewtags = $this->projectService->getTags();
            if (!$editproject) {
                redirectTo('/');
            }

            echo $this->view->render("editproject.php", [
                'editproject' => $editproject,
                "viewcustomer" => $viewcustomer,
                "users" => $users,
                'tags' => $viewtags
            ]);
        } else {
            $this->validatorService->validateProject($_POST);
            $this->projectService->update($_POST, (int) $params['project']);
            redirectTo('/projects/AllProjects');
        }
    }
    public function deleteProject(array $id)
    {

        if ($id['project'] === "0") {
            $this->projectService->delete($_POST['ids']);
            redirectTo('/projects/AllProjects');
        } else {
            $this->projectService->delete([$id['project']]);//'customer' -> route parameter
            redirectTo('/projects/AllProjects');
        }
    }

}