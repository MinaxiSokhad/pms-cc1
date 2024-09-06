<?php
declare(strict_types=1);
namespace App\Controllers;

use Framework\Exceptions\ValidationException;
use Framework\TemplateEngine;
use App\Services\{CustomerService, ProjectService, ValidatorService, UserService, TaskService};
class TaskController
{
    public function __construct(
        private TemplateEngine $view,
        private CustomerService $customerService,
        private ProjectService $projectService,
        private TaskService $taskService,
        private ValidatorService $validatorService,
        private UserService $userService
    ) {

    }
    public function taskView()
    {
        $viewtask = [];
        $count = 0;
        $_POST['select_limit'] = $_POST['select_limit'] ? $_POST['select_limit'] : 3;
        $showRecord = $_POST['select_limit'];

        if ($showRecord != "1") {
            $page = isset($_POST['p']) ? (int) $_POST['p'] : 1;
            $limit = isset($_POST['select_limit']) ? $_POST['select_limit'] : 3;
            $offset = (int) ($page - 1) * $limit;
        } else {
            $page = '';
            $limit = '';
            $offset = '';
        }
        $order_by = 'id';
        $direction = 'desc';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (array_key_exists('order_by', $_POST)) {
                $order_by = $_POST['order_by'];
                $direction = $_POST['direction'];
            }

            if ($_POST['s']) {
                if (array_key_exists('status', $_POST)) {
                    [$viewtask, $count] = $this->taskService->getTask($_POST['status'], $_POST['s'], $order_by, $direction, (int) $limit, (int) $offset);
                } else {
                    [$viewtask, $count] = $this->taskService->getTask(searchTerm: $_POST['s'], order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);

                }
            }
            if (array_key_exists('status', $_POST)) {
                if ($_POST['s'] != '') {
                    [$viewtask, $count] = $this->taskService->getTask($_POST['status'], searchTerm: $_POST['s'], order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
                } else {
                    [$viewtask, $count] = $this->taskService->getTask($_POST['status'], '', $order_by, $direction, (int) $limit, (int) $offset);
                }
            }
            if ($_POST['s'] == '' && !array_key_exists('status', $_POST)) {
                [$viewtask, $count] = $this->taskService->getTask(order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
            }

        } else {
            [$viewtask, $count] = $this->taskService->getTask([], '', order_by: $order_by, direction: $direction, limit: (int) $limit, offset: (int) $offset);
        }
        // dd($count);
        if ($showRecord != '1') {
            $lastPage = ceil($count / $limit);//Find total page
        }
        $task_status = $this->taskService->getTaskStatus();
        $viewproject = $this->projectService->getoneproject();
        echo $this->view->render("tasks.php", [
            'viewtask' => $viewtask,
            'currentPage' => $page,
            'lastPage' => $lastPage,
            'task_status' => $task_status,
            'record' => $count,
            'viewproject' => $viewproject
        ]);
    }
    public function createTask()
    {
        if ($_SESSION['user_type'] == "A") {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $viewproject = $this->projectService->getoneproject();
                $users = $this->projectService->getUser();
                $viewtags = $this->projectService->getTags();
                echo $this->view->render("createtask.php", [
                    "viewproject" => $viewproject,
                    "users" => $users,
                    'tags' => $viewtags
                ]);
            } else {
                $this->validatorService->validateTask($_POST);
                // if ($this->validatorService->isExists('task', 'name', $_POST['name'])) {
                //     throw new ValidationException(['name' => ['Task Name Already Exists']]);
                // }
                $this->taskService->create($_POST);
                redirectTo('/tasks');
            }
        } else {
            echo $this->view->render("errors/permission-error.php");
        }
    }
    public function updateTask(array $params = [])
    {
        if ($_SESSION['user_type'] == "A") {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $edittask = $this->taskService->getonetask($params["task"]);
                $viewproject = $this->projectService->getoneproject();
                $users = $this->projectService->getUser();
                $viewtags = $this->projectService->getTags();
                if (!$edittask) {
                    redirectTo('/');
                }

                echo $this->view->render("edittask.php", [
                    'edittask' => $edittask,
                    "viewproject" => $viewproject,
                    "users" => $users,
                    'tags' => $viewtags
                ]);
            } else {
                $this->validatorService->validateTask($_POST);
                $this->taskService->update($_POST, (int) $params['task']);
                redirectTo('/tasks');
            }
        } else {
            echo $this->view->render("errors/permission-error.php");
        }
    }
    public function deleteTask(array $id)
    {
        if ($_SESSION['user_type'] == "A") {

            if ($id['task'] === "0") {
                $this->taskService->delete($_POST['ids']);
                redirectTo('/tasks');
            } else {
                $this->taskService->delete([$id['task']]);
                redirectTo('/tasks');
            }
        } else {
            echo $this->view->render("errors/permission-error.php");
        }
    }
}
?>