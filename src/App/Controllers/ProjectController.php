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
            $viewcustomer = $this->customerService->getcustomers();
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
            redirectTo('/projects');
        }
    }
    public function projectView(array $params = [])
    {

        $page = 1;
        $limit = 3;
        $offset = 0;
        $order_by = 'id';
        $direction = 'desc';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $page = isset($_POST['p']) ? (int) $_POST['p'] : 1;
            $offset = (int) ($page - 1) * $limit;
            if (array_key_exists('order_by', $_POST)) {
                $order_by = $_POST['order_by'];
                $direction = $_POST['direction'];
            }
            if ($_POST['s']) {

                [$viewproject, $count] = $this->projectService->getProject(searchTerm: $_POST['s'], order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
            }
            if (array_key_exists('status', $_POST)) {
                [$viewproject, $count] = $this->projectService->getProject($_POST['status'], '', $order_by, $direction, (int) $limit, (int) $offset);
            }
            if ($_POST['s'] == '' && !array_key_exists('status', $_POST)) {
                [$viewproject, $count] = $this->projectService->getProject(order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
            }
        } else {
            [$viewproject, $count] = $this->projectService->getProject([], '', order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
        }

        $lastPage = ceil($count / $limit);//Find total page

        echo $this->view->render("projects.php", [
            'viewproject' => $viewproject,
            'currentPage' => $page,
            'previousPageQuery' => http_build_query([
                'p' => $page - 1
            ]),
            'lastPage' => $lastPage,
            'nextPageQuery' => http_build_query([
                'p' => $page + 1
            ])

        ]);
    }
    public function page()
    {
        echo $this->view->render('page.php');
    }
    public function updateProject(array $params = [])
    {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $editproject = $this->projectService->getoneproject($params["project"]);
            $viewcustomer = $this->customerService->getcustomers();
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
            redirectTo('/projects');
        }
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