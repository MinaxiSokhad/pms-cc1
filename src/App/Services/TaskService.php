<?php
declare(strict_types=1);
namespace App\Services;

use Exception;
use Framework\Database;
use Framework\Exceptions\ValidationException;
use App\Services\ValidatorService;
class TaskService
{
    public function __construct(private Database $db, private ValidatorService $validatorService)
    {
    }
    public function getTask(array $status = [], string $searchTerm = '', string $order_by = 'id', string $direction = 'desc', int $limit = 3, int $offset = 0)
    {
        $filter = isset($filter) ? $filter : '';
        $search = isset($search) ? $search : '';
        $order = "ORDER BY " . $order_by . " " . $direction;
        $param = [];
        $where = " WHERE task.id > 0 ";
        $having = "";
        if ($limit != 0) {
            $limit_offset = " LIMIT " . $limit . " OFFSET " . $offset;
        } else {
            $limit_offset = '';
        }

        if (!empty($status)) {
            $ids = [];
            foreach ($status as $i) {
                $ids[] = (string) $i;
            }
            $status = implode("','", $ids);
            $filter .= " AND `task`.`status` IN ('$status') ";
        }
        if ($searchTerm != '') {
            $search .= " AND  (task.name LIKE :search 
            OR task.priority LIKE :search
            OR tags.name LIKE :search
            OR user.name LIKE :search) ";
            $param = ['search' => "%{$searchTerm}%"];
        }
        if ($_SESSION['user_type'] != "A") {
            $having = " HAVING COUNT(CASE WHEN task_member.user_id =:id THEN 1 ELSE NULL END) > 0 ";
            $param = ['id' => $_SESSION['user']];
        }
        if ($_SESSION['user_type'] != "A" && $searchTerm != '') {
            // dd($param);
            $search .= " AND  (task.name LIKE :search 
            OR task.priority LIKE :search
            OR tags.name LIKE :search
            OR user.name LIKE :search) ";
            $having = " HAVING COUNT(CASE WHEN task_member.user_id =:id THEN 1 ELSE NULL END) > 0  ";
            $param = [
                'search' => "%{$searchTerm}%",
                'id' => $_SESSION['user']
            ];
        }

        $query = "SELECT
              task.id,
              project.name as project,
              task.name,
             DATE_FORMAT(task.start_date ,'%Y-%m-%d') as start_date,
             DATE_FORMAT(task.due_date ,'%Y-%m-%d') as due_date,
              CASE 
                    WHEN task.priority = 'H' THEN 'High' 
                    WHEN task.priority = 'M' THEN 'Medium' 
                    WHEN task.priority = 'L' THEN 'Low'  
                    ELSE task.priority 
                END AS `priority`,
              CASE 
                    WHEN task.status = 'S' THEN 'Not Started' 
                    WHEN task.status = 'P' THEN 'In Progress' 
                    WHEN task.status = 'C' THEN 'Complete' 
                    WHEN task.status = 'T' THEN 'Testing' 
                    ELSE task.status 
                END AS `status`,
              GROUP_CONCAT(DISTINCT tags.name SEPARATOR ',') as `task_tags_name`,
              GROUP_CONCAT(DISTINCT `user`.name  ORDER BY user.id SEPARATOR ',')as `task_member_name`,
              GROUP_CONCAT(DISTINCT `user`.id  ORDER BY user.id SEPARATOR ',')as `task_member_id`
            FROM task
            JOIN task_tags
              ON task.id = task_tags.task_id
              JOIN task_member
              ON task.id = task_member.task_id
              JOIN tags 
              ON task_tags.tags_id = tags.id
              JOIN user
              ON task_member.user_id = `user`.id
              JOIN project
              ON task.project = project.id
               " . $where . $search . $filter . " GROUP BY task.id " . $having;
        $viewtask = $this->db->query(
            $query,
            $param
        )->findAll();

        $recordCount = count($viewtask);
        $viewtask = $this->db->query(
            $query . $order . $limit_offset,
            $param
        )->findAll();
        return [$viewtask, $recordCount];
        if (empty($status)) {
            die("Project not found.");
        }
    }
    public function getTaskStatus()
    {

        return [
            $this->db->query(
                "SELECT COUNT(`status`) as 'S' FROM task WHERE `status`='S'"
            )->find(),
            $this->db->query(
                "SELECT COUNT(`status`) as 'P' FROM task WHERE `status`='P'"
            )->find(),
            $this->db->query(
                "SELECT COUNT(`status`) as 'C' FROM task WHERE `status`='C'"
            )->find(),
            $this->db->query(
                "SELECT COUNT(`status`) as 'T' FROM task WHERE `status`='T'"
            )->find()
        ];
    }
    public function userAssignTaskStatus()
    {

        return [
            $this->db->query("SELECT COUNT(`task`.`status`) as 'S' FROM task
              JOIN task_member
              ON task.id = task_member.task_id
              JOIN user
              ON task_member.user_id = `user`.id
    WHERE `task`.`status`='S' AND task_member.user_id =:id", [
                'id' => $_SESSION['user']
            ])->find(),
            $this->db->query("SELECT COUNT(`task`.`status`) as 'P' FROM task
              JOIN task_member
              ON task.id = task_member.task_id
              JOIN user
              ON task_member.user_id = `user`.id
    WHERE `task`.`status`='P' AND task_member.user_id =:id", [
                'id' => $_SESSION['user']
            ])->find(),
            $this->db->query("SELECT COUNT(`task`.`status`) as 'C' FROM task
              JOIN task_member
              ON task.id = task_member.task_id
              JOIN user
              ON task_member.user_id = `user`.id
    WHERE `task`.`status`='C' AND task_member.user_id =:id", [
                'id' => $_SESSION['user']
            ])->find(),
            $this->db->query("SELECT COUNT(`task`.`status`) as 'T' FROM task
              JOIN task_member
              ON task.id = task_member.task_id
              JOIN user
              ON task_member.user_id = `user`.id
    WHERE `task`.`status`='T' AND task_member.user_id =:id", [
                'id' => $_SESSION['user']
            ])->find(),
        ];

    }
    public function create(array $formData)
    {
        $task_id = 0;
        try {
            $formattedStartDate = "{$formData['start_date']} 00:00:00";
            $formattedDueDate = "{$formData['due_date']} 00:00:00";
            $this->db->query(
                "INSERT INTO task (project,name,start_date,due_date,status,priority)
             VALUES (:project,:name,:start_date,:due_date,:status,:priority)",
                [
                    "project" => $formData["project"],
                    "name" => $formData["name"],
                    "start_date" => $formattedStartDate,
                    "due_date" => $formattedDueDate,
                    "status" => $formData["status"],
                    "priority" => $formData["priority"]
                ]
            );
            $task_id = (int) $this->db->id();
            $tag_ids = implode(',', $_POST['tags']);
            $project_id = $_POST['project'];
            $this->db->query(
                "INSERT INTO task_tags(task_id,project_id,tags_id) SELECT :task_id,:project_id,id FROM tags WHERE id IN ($tag_ids)",
                [
                    'task_id' => $task_id,
                    'project_id' => $project_id
                ]
            );
            $m_ids = implode(',', $_POST['members']);
            $this->db->query(
                "INSERT INTO task_member(task_id,project_id,user_id) SELECT :task_id,:project_id,id FROM user WHERE id IN ($m_ids)",
                [
                    "task_id" => $task_id,
                    'project_id' => $project_id
                ]
            );
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function getonetask($id = 0)
    {
        if (!empty($id)) {
            $where = " WHERE task.id IN ('$id') ";
            return $this->db->query(
                " SELECT
              task.id,
              project.name as project,
              task.name,
             DATE_FORMAT(task.start_date ,'%Y-%m-%d') as start_date,
             DATE_FORMAT(task.due_date ,'%Y-%m-%d') as due_date,
              CASE 
                    WHEN task.priority = 'H' THEN 'High' 
                    WHEN task.priority = 'M' THEN 'Medium' 
                    WHEN task.priority = 'L' THEN 'Low'  
                    ELSE task.priority 
                END AS `priority`,
              CASE 
                    WHEN task.status = 'S' THEN 'Not Started' 
                    WHEN task.status = 'P' THEN 'In Progress' 
                    WHEN task.status = 'C' THEN 'Complete' 
                    WHEN task.status = 'T' THEN 'Testing' 
                    ELSE task.status 
                END AS `status`,
              GROUP_CONCAT(DISTINCT tags.name SEPARATOR ',') as `task_tags_name`,
              GROUP_CONCAT(DISTINCT `user`.name SEPARATOR ',')as `task_member_name`,
              GROUP_CONCAT(DISTINCT `user`.id SEPARATOR ',') as `task_member_id`
             
            FROM task
            JOIN task_tags
              ON task.id = task_tags.task_id
              JOIN task_member
              ON task.id = task_member.task_id
              JOIN tags 
              ON task_tags.tags_id = tags.id
              JOIN user
              ON task_member.user_id = `user`.id
              JOIN project
              ON task.project = project.id
               $where 
               GROUP BY task.id "
            )->find();
        } else {
            return $this->db->query(
                "SELECT * FROM task"
            )->findAll();
        }
    }
    public function update(array $formData, int $id)
    {
        $formattedStartDate = "{$formData['start_date']} 00:00:00";
        $formattedDueDate = "{$formData['due_date']} 00:00:00";
        $this->db->query(
            "UPDATE task SET project=:project,name=:name,start_date=:start_date,due_date=:due_date,status=:status,priority=:priority WHERE id=:id",
            [
                "project" => $formData["project"],
                "name" => $formData["name"],
                "start_date" => $formattedStartDate,
                "due_date" => $formattedDueDate,
                "status" => $formData["status"],
                "priority" => $formData["priority"],
                "id" => $id

            ]
        );
        $this->db->query(
            "DELETE FROM `task_tags` WHERE `task_id`=:task_id",
            [
                'task_id' => $id,
            ]
        );
        $tag_ids = implode(',', $_POST['tags']);
        $project_id = $_POST['project'];
        $this->db->query(
            "INSERT INTO task_tags(task_id,project_id,tags_id) SELECT :task_id,:project_id,id FROM tags WHERE id IN ($tag_ids)",
            [
                'task_id' => $id,
                'project_id' => $project_id
            ]
        );
        $this->db->query(
            "DELETE FROM `task_member` WHERE `task_id`=:task_id",
            [
                'task_id' => $id,
            ]
        );
        $m_ids = implode(',', $_POST['members']);
        $this->db->query(
            "INSERT INTO task_member(task_id,project_id,user_id) SELECT :task_id,:project_id,id FROM user WHERE id IN ($m_ids)",
            [
                'task_id' => $id,
                'project_id' => $project_id
            ]
        );
    }
    public function delete(array $id)
    {
        $ids = [];
        foreach ($id as $i) {
            $ids[] = (int) $i;
        }
        $ids = implode(',', ($ids));
        $sql = "DELETE FROM task WHERE id IN ('$ids')";
        return $this->db->query($sql);

    }
}