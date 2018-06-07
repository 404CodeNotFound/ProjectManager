<?php
namespace models;

include '../helpers/Constants.php';
use libs\Db;

class Task
{
    private $id;
    private $title;
    private $description;
    private $priority;
    private $story_points;
    private $sprint_id;
    private $project_id;
    private $assigned_to;
    private $assigned_to_username;
    private $status;

    public function __construct() {

    }

    public static function create($title, $description, $priority, $story_points, $sprint_id, $assigned_to, $status)
    {
        $instance = new self();
        $instance->setTitle($title);
        $instance->setDescription($description);
        $instance->setPriority($priority);
        $instance->setStoryPoints($story_points);
        $instance->setSprint($sprint_id);
        $instance->setAssignedTo($assigned_to);
        $instance->setStatus($status);
        
        return $instance;
    }

    public function setId($id)
    {    
        $this->id = $id;
    }

    public function getId()
    {    
        return $this->id;
    }

    public function setTitle($title)
    {    
        $this->title = $title;
    }

    public function getTitle()
    {    
        return $this->title;
    }

    public function setDescription($description)
    {    
        $this->description = $description;
    }

    public function getDescription()
    {    
        return $this->description;
    }

    public function setPriority($priority)
    {   
        if (in_array($priority, PRIORITIES))
        {
            $this->priority = $priority;
        }
        else
        {
            $this->priority = PRIORITIES[0];
        }
    }

    public function getPriority()
    {    
        return $this->priority;
    }

    public function setStoryPoints($story_points)
    {
        if ($story_points >= 0 && $story_points <= 100)
        {
            $this->story_points = $story_points;
        }
        else
        {
            $this->story_points = 0;
        }
    }

    public function getStoryPoints()
    {    
        return $this->story_points;
    }

    public function setSprint($sprint_id)
    {    
        $this->sprint_id = $sprint_id;
    }

    public function getSprint()
    {    
        return $this->sprint_id;
    }

    public function setSprintName($sprint_name)
    {    
        $this->sprint_name = $sprint_name;
    }

    public function getSprintName()
    {    
        return $this->sprint_name;
    }

    public function setProject($project_id)
    {
        $this->project_id = $project_id;
    }

    public function getProject()
    {
        return $this->project_id;
    }

    public function setAssignedTo($assigned_to)
    {    
        $this->assigned_to = $assigned_to;
    }

    public function getAssignedTo()
    {    
        return $this->assigned_to;
    }

    public function setAssignedToUsername($username)
    {    
        $this->assigned_to_username = $username;
    }

    public function getAssignedToUsername()
    {    
        return $this->assigned_to_username;
    }

    
    public function setStatus($status)
    {    
        if (in_array($status, STATUSES))
        {
            $this->status = $status;
        }
        else
        {
            $this->status = STATUSES[0];
        }
    }

    public function getStatus()
    {    
        return $this->status;
    }

    public function insert()
    {
        $query = (new Db())->getConn()->prepare("INSERT INTO `tasks` (title, description, priority, story_points, sprint_id, status) VALUES (?, ?, ?, ?, ?, ?) ");
        
        return $query->execute([$this->title, $this->description, $this->priority, $this->story_points, $this->sprint_id, $this->status]);
    }

    public static function getTaskById($id)
    {
        $query = (new Db())->getConn()->prepare("SELECT t.id, t.title, t.description, t.priority, t.story_points, t.sprint_id, s.name, s.project_id, u.id as user_id, u.username, t.status
            FROM tasks t JOIN sprints s ON t.sprint_id = s.id LEFT JOIN users u ON t.assigned_to = u.id WHERE t.id = '$id'");
        $query->execute();

        $task = new Task();
        while ($taskData = $query->fetch())
        {
            $task->setId($taskData['id']);
            $task->setTitle($taskData['title']);
            $task->setDescription($taskData['description']);
            $task->setPriority($taskData['priority']);
            $task->setStoryPoints($taskData['story_points']);
            $task->setSprint($taskData['sprint_id']);
            $task->setSprintName($taskData['name']);
            $task->setProject($taskData['project_id']);
            $task->setAssignedTo($taskData['user_id']);
            $task->setAssignedToUsername($taskData['username']);
            $task->setStatus($taskData['status']);            
        }

        return $task;
    }

    public static function getAllSprintTasks($sprint_id)
    {
        $query = (new Db())->getConn()->prepare("SELECT id, title, status FROM tasks WHERE sprint_id = '$sprint_id'");
        $query->execute();

        $tasks = [];
        while ($found_task = $query->fetch())
        {
            $task = new Task();
            $task->setTitle($found_task["title"]);
            $task->setId($found_task["id"]);
            $task->setStatus($found_task["status"]);            
            $tasks[] = $task;
        }

        return $tasks;
    }

    // public static function edit($task_id, $title, $description, $priority, $story_points, $status, $assigned_to)
    // {
    //     $query = (new Db())->getConn()->prepare("UPDATE tasks SET title=?, description=?, priority=?, story_points=?, assigned_to=?, status=? WHERE id=?");
        
    //     return $query->execute([$title, $description, $priority, $story_points, $status, $assigned_to $task_id]);
    // }
  }

  function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }
?>