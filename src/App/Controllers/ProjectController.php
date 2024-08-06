<?php
declare(strict_types=1);
namespace App\Controllers;

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
    public function createProject()
    {
        $viewcustomer = $this->customerService->getCustomer();
        $users = $this->projectService->getUser();
        $viewtags = $this->projectService->getTags();
        echo $this->view->render("createproject.php", [
            "viewcustomer" => $viewcustomer,
            "users" => $users,
            'tags' => $viewtags
        ]);
    }
    public function project()
    {
        $this->validatorService->validateProject($_POST);
        $this->userService->isNameTakenProject($_POST['name']);
        $this->projectService->create($_POST);
        redirectTo('/projects');
    }
    public function prj()
    {
        dd("Hi");

    }
    public function projectView(array $params = [])
    {


        $searchTerm = $_GET['s'] ?? null;

        $name = explode("_", $params["status"]);
        // dd();
        if (empty($params) || $params['status'] == "AllProjects") {

            $viewproject = $this->projectService->getProject();
        } else if (count($name) == 2 && ($name[1] == "asc" || $name[1] = "desc")) {

            $viewproject = $this->projectService->sort($name[0], $name[1]);
        } else {

            $viewproject = $this->projectService->show($params['status']);

        }
        if (isset($searchTerm)) {
            $viewproject = $this->projectService->getProjectSearch();
        }


        echo $this->view->render("projects.php", [
            'viewproject' => $viewproject,
            'searchTerm' => $searchTerm

        ]);
    }
    public function projectSort(array $params = [])
    {
        $viewproject = [];

        $name = explode("_", $params["s"]);
        $viewproject = array_merge($viewproject, $this->projectService->sort($name[0], $name[1]));
        echo $this->view->render("projects.php", [
            'viewproject' => $viewproject,
            'searchTerm' => ''
        ]);

    }
    public function editProjectView(array $params = [])
    {
        $editproject = $this->projectService->getcreatedProject((int) $params["project"]);
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
    }
    public function updateProject(array $params = [])
    {

        $this->validatorService->validateProject($_POST);
        $this->projectService->update($_POST, (int) $params['project']);
        redirectTo('/projects');
    }
    public function deleteProject(array $id)
    {

        if ($id['project'] === "0") {
            $this->projectService->delete($_POST['ids']);
            redirectTo('/projects');
        } else {
            $this->projectService->delete([$id['project']]);//'customer' -> route parameter
            redirectTo('/projects');
        }
    }

}