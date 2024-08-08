<?php
declare(strict_types=1);
namespace App\Services;

use Exception;
use Framework\Database;
use Framework\Exceptions\ValidationException;
use App\Services\ValidatorService;

class ProjectService
{
    public function __construct(private Database $db, private ValidatorService $validatorService)
    {
    }
    public function getUser(int $id = 0)
    {
        $params = [];
        if ($id > 0) {
            $where = " WHERE id=:id";
            $params["id"] = $id;
        } else {
            $where = "";
        }

        return $this->db->query(
            "SELECT * FROM user " . $where,
            $params
        )->findAll();


        if (!isset($id)) {
            die("User not found.");
        }
    }
    public function getTags(int $id = 0)
    {
        $params = [];
        if ($id > 0) {
            $where = " WHERE id=:id";
            $params["id"] = $id;
        } else {
            $where = "";
        }

        return $this->db->query(
            "SELECT * FROM tags " . $where,
            $params
        )->findAll();


        if (!isset($id)) {
            die("Tags not found.");
        }
    }
    public function create(array $formData)
    {
        $project_id = 0;
        try {
            $formattedStartDate = "{$formData['start_date']} 00:00:00";
            $formattedEndDate = "{$formData['deadline']} 00:00:00";
            $this->db->query(
                "INSERT INTO project (name,description,customer,start_date,deadline,status)
             VALUES (:name,:description,:customer,:start_date,:deadline,:status)",
                [
                    "name" => $formData["name"],
                    "description" => $formData["description"],
                    "customer" => $formData["customer"],
                    "start_date" => $formattedStartDate,
                    "deadline" => $formattedEndDate,
                    "status" => $formData["status"]
                ]
            );
            $project_id = (int) $this->db->id();
            $tag_ids = implode(',', $_POST['tags']);

            $this->db->query(
                "INSERT INTO project_tags(project_id,tags_id) SELECT :project_id,id FROM tags WHERE id IN ($tag_ids)",
                [
                    'project_id' => $project_id,
                ]
            );

            // $m_ids = [];
            // foreach ($_POST['members'] as $members) {
            //     $m_ids[] = (int) $members;
            // }
            $m_ids = implode(',', $_POST['members']);
            $this->db->query(
                "INSERT INTO project_member(project_id,user_id) SELECT :project_id,id FROM user WHERE id IN ($m_ids)",
                [
                    "project_id" => $project_id
                ]
            );
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getProject(array $id = [])
    {
        if (!empty($id)) {
            $ids = [];
            foreach ($id as $i) {
                $ids[] = (int) $i;
            }
            $id = implode(",", $ids);

            $where = "WHERE project.id IN ($id)";
            if (count($ids) > 1) {
                return $this->db->query(
                    "SELECT
              project.id,
              project.name,
              project.description,
              customers.company as `customer`,
              project.start_date,
              project.deadline,
              CASE 
                    WHEN project.status = 'S' THEN 'Not Started' 
                    WHEN project.status = 'P' THEN 'In Progress' 
                    WHEN project.status = 'H' THEN 'On Hold' 
                    WHEN project.status = 'C' THEN 'Cancelled' 
                    WHEN project.status = 'F' THEN 'Finished' 
                    ELSE project.status 
                END AS `status`,
              GROUP_CONCAT(DISTINCT tags.name SEPARATOR ',') as `project_tags_name`,
              GROUP_CONCAT(DISTINCT `user`.name SEPARATOR ',')as `project_member_name`
            FROM project
            JOIN project_tags
              ON project.id = project_tags.project_id
              JOIN project_member
              ON project.id = project_member.project_id
              JOIN tags 
              ON project_tags.tags_id = tags.id
              JOIN user
              ON project_member.user_id = `user`.id
              JOIN customers
              ON project.customer = customers.id
              $where
            GROUP BY
                project.id"

                )->findAll();
            } else {
                return $this->db->query(
                    "SELECT
              project.id,
              project.name,
              project.description,
              customers.company as `customer`,
              project.start_date,
              project.deadline,
              CASE 
                    WHEN project.status = 'S' THEN 'Not Started' 
                    WHEN project.status = 'P' THEN 'In Progress' 
                    WHEN project.status = 'H' THEN 'On Hold' 
                    WHEN project.status = 'C' THEN 'Cancelled' 
                    WHEN project.status = 'F' THEN 'Finished' 
                    ELSE project.status 
                END AS `status`,
              GROUP_CONCAT(DISTINCT tags.name SEPARATOR ',') as `project_tags_name`,
              GROUP_CONCAT(DISTINCT `user`.name SEPARATOR ',')as `project_member_name`
            FROM project
            JOIN project_tags
              ON project.id = project_tags.project_id
              JOIN project_member
              ON project.id = project_member.project_id
              JOIN tags 
              ON project_tags.tags_id = tags.id
              JOIN user
              ON project_member.user_id = `user`.id
              JOIN customers
              ON project.customer = customers.id
              $where
            GROUP BY
                project.id"
                )->find();
            }

        } else {
            $where = "";
            return $this->db->query(
                "SELECT
          project.id,
          project.name,
          project.description,
          customers.company as `customer`,
          project.start_date,
          project.deadline,
          CASE 
                WHEN project.status = 'S' THEN 'Not Started' 
                WHEN project.status = 'P' THEN 'In Progress' 
                WHEN project.status = 'H' THEN 'On Hold' 
                WHEN project.status = 'C' THEN 'Cancelled' 
                WHEN project.status = 'F' THEN 'Finished' 
                ELSE project.status 
            END AS `status`,
          GROUP_CONCAT(DISTINCT tags.name SEPARATOR ',') as `project_tags_name`,
          GROUP_CONCAT(DISTINCT `user`.name SEPARATOR ',')as `project_member_name`
        FROM project
        JOIN project_tags
          ON project.id = project_tags.project_id
          JOIN project_member
          ON project.id = project_member.project_id
          JOIN tags 
          ON project_tags.tags_id = tags.id
          JOIN user
          ON project_member.user_id = `user`.id
          JOIN customers
          ON project.customer = customers.id
          $where
        GROUP BY
            project.id"
            )->findAll();
        }
        if (!isset($id)) {
            die("Project not found.");
        }
    }
    public function update(array $formData, int $id)
    {
        if ($this->validatorService->isExists('project', 'name', $formData['name'], 'id !=' . $id)) {
            throw new ValidationException(['name' => ['Project name already Exists']]);
        }
        $formattedStartDate = "{$formData['start_date']} 00:00:00";
        $formattedEndDate = "{$formData['deadline']} 00:00:00";
        $this->db->query(
            "UPDATE project SET name=:name,description=:description,customer=:customer,start_date=:start_date,deadline=:deadline,status=:status WHERE id=:id",
            [
                "name" => $formData["name"],
                "description" => $formData["description"],
                "customer" => $formData["customer"],
                "start_date" => $formattedStartDate,
                "deadline" => $formattedEndDate,
                "status" => $formData["status"],
                "id" => $id
            ]
        );


        $this->db->query(
            "DELETE FROM `project_tags` WHERE `project_id`=:project_id",
            [
                'project_id' => $id,
            ]
        );
        $tag_ids = implode(',', $_POST['tags']);

        $this->db->query(
            "INSERT INTO project_tags(project_id,tags_id) SELECT :project_id,id FROM tags WHERE id IN ($tag_ids)",
            [
                'project_id' => $id,
            ]
        );
        $this->db->query(
            "DELETE FROM `project_member` WHERE `project_id`=:project_id",
            [
                'project_id' => $id,
            ]
        );
        $m_ids = implode(',', $_POST['members']);
        $this->db->query(
            "INSERT INTO project_member(project_id,user_id) SELECT :project_id,id FROM user WHERE id IN ($m_ids)",
            [
                "project_id" => $id
            ]
        );
    }

    public function delete(array $id)
    {

        $placeholders = implode(',', array_fill(0, count($id), '?'));
        $sql = "DELETE FROM project WHERE id IN ($placeholders)";
        return $this->db->query($sql, $id);

    }
    public function getProjectStatus()
    {

        return [
            $this->db->query(
                "SELECT COUNT(`status`) as 'S' FROM `project` where `status` = 'S'"
            )->find(),
            $this->db->query(
                "SELECT COUNT(`status`) as 'P' FROM `project` where `status` = 'P'"
            )->find(),
            $this->db->query(
                "SELECT COUNT(`status`) as 'H' FROM `project` where `status` = 'H'"
            )->find(),
            $this->db->query(
                "SELECT COUNT(`status`) as 'C' FROM `project` where `status` = 'C'"
            )->find(),
            $this->db->query(
                "SELECT COUNT(`status`) as 'F' FROM `project` where `status` = 'F'"
            )->find()
        ];

    }
    public function show(string $status)
    {


        return $this->db->query("SELECT
  project.id,
  project.name,
  project.description,
  customers.company as `customer`,
  project.start_date,
  project.deadline,
  CASE 
        WHEN project.status = 'S' THEN 'Not Started' 
        WHEN project.status = 'P' THEN 'In Progress' 
        WHEN project.status = 'H' THEN 'On Hold' 
        WHEN project.status = 'C' THEN 'Cancelled' 
        WHEN project.status = 'F' THEN 'Finished' 
        ELSE project.status 
    END AS status,
  GROUP_CONCAT(DISTINCT tags.name SEPARATOR ',') as `project_tags_name`,
  GROUP_CONCAT(DISTINCT `user`.name SEPARATOR ',')as `project_member_name`
FROM project
JOIN project_tags
  ON project.id = project_tags.project_id
  JOIN project_member
  ON project.id = project_member.project_id
  JOIN tags 
  ON project_tags.tags_id = tags.id
  JOIN user
  ON project_member.user_id = `user`.id
  JOIN customers
  ON project.customer = customers.id 
  WHERE project.status =:status
GROUP BY
	project.id ", [
            'status' => $status
        ])->findAll();

        if (!isset($id)) {
            die("Project not found.");
        }
    }
    public function sort(string $order_by = "id", string $direction = "asc")
    {

        $searchTerm = addcslashes($_GET['s'] ?? '', '%_'); //search any character or special character like %
        $param = [

            "search" => "%{$searchTerm}%"

        ];
        if ($order_by == "name") {
            $order_by = " ORDER BY project.name " . $direction;
        } else if ($order_by == "description") {
            $order_by = " ORDER BY project.description " . $direction;
        } else if ($order_by == "customer") {
            $order_by = " ORDER BY customers.company " . $direction;
        } else if ($order_by == "startdate") {
            $order_by = " ORDER BY project.start_date " . $direction;
        } else if ($order_by == "deadline") {
            $order_by = " ORDER BY project.deadline " . $direction;
        } else if ($order_by == "status") {
            $order_by = " ORDER BY project.status " . $direction;
        } else if ($order_by == "tags") {
            $order_by = " ORDER BY tags.name " . $direction;
        } else if ($order_by == "members") {
            $order_by = " ORDER BY user.name " . $direction;
        } else {
            $order_by = " ORDER BY project.id ASC";
        }

        return $this->db->query("SELECT
        project.id,
        project.name,
        project.description,
        customers.company as `customer`,
        project.start_date,
        project.deadline,
        CASE 
              WHEN project.status = 'S' THEN 'Not Started' 
              WHEN project.status = 'P' THEN 'In Progress' 
              WHEN project.status = 'H' THEN 'On Hold' 
              WHEN project.status = 'C' THEN 'Cancelled' 
              WHEN project.status = 'F' THEN 'Finished' 
              ELSE project.status 
          END AS status,
        GROUP_CONCAT(DISTINCT tags.name SEPARATOR ',') as `project_tags_name`,
        GROUP_CONCAT(DISTINCT `user`.name SEPARATOR ',')as `project_member_name`
      FROM project
      JOIN project_tags
        ON project.id = project_tags.project_id
        JOIN project_member
        ON project.id = project_member.project_id
        JOIN tags 
        ON project_tags.tags_id = tags.id
        JOIN user
        ON project_member.user_id = `user`.id
        JOIN customers
        ON project.customer = customers.id 
        WHERE project.name LIKE :search 
            OR project.description LIKE :search
            OR project.status LIKE :search
            OR tags.name LIKE :search
            OR user.name LIKE :search
      GROUP BY
          project.id " . $order_by . ";", $param)->findAll();
    }
}
