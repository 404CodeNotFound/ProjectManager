<?php
namespace models;
use libs\Db;

class Sprint
{
    private $id;
    private $name;
    private $start_date;
    private $end_date;
    private $goal;
    private $project_id;
    private $project_title;
    private $is_active;
    
    public function __construct() {

    }

    public static function create($name, $start_date, $end_date, $goal, $project)
    {
        $instance = new self();
        $instance->setName($name);
        $instance->setStartDate($start_date);
        $instance->setEndDate($end_date);
        $instance->setGoal($goal);
        $instance->setProject($project);
        
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

    public function setName($name)
    {    
        $this->name = $name;
    }

    public function getName()
    {    
        return $this->name;
    }

    public function setStartDate($start_date)
    {    
        $this->start_date = $start_date;
    }

    public function getStartDate()
    {    
        return $this->start_date;
    }

    public function setEndDate($end_date)
    {    
        $this->end_date = $end_date;
    }

    public function getEndDate()
    {    
        return $this->end_date;
    }

    public function setGoal($goal)
    {
        $this->goal = $goal;
    }

    public function getGoal()
    {
        return $this->goal;
    }

    public function setProject($project_id)
    {    
		$this->project_id = $project_id;
    }

    public function getProject()
    {    
		return $this->project_id;
    }

    public function setProjectTitle($project_title)
    {    
		$this->project_title = $project_title;
    }

    public function getProjectTitle()
    {    
		return $this->project_title;
    }

    public function getIsActive()
    {
        $current_date = date_create(date("Y-m-d"));
        $diff = (int)date_diff($current_date, $this->end_date)->format("%r%a");

        if($diff > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function insert()
    {
        $query = (new Db())->getConn()->prepare("INSERT INTO `sprints` (name, start_date, end_date, goal, project_id) VALUES (?, ?, ?, ?, ?) ");
        
        return $query->execute([$this->name, $this->start_date, $this->end_date, $this->goal, $this->project_id]);
    }

    public static function getAllSprintsOfProject($project_id)
    {
        $query = (new Db())->getConn()->prepare("SELECT id, name FROM sprints WHERE project_id = '$project_id'");
        $query->execute();

        $sprints = [];
        while ($found_sprint = $query->fetch())
        {
            $sprint = new Sprint();            
            $sprint->setName($found_sprint["name"]);
            $sprint->setId($found_sprint["id"]);            
            $sprints[] = $sprint;
        }

        return $sprints;
    }

    public static function getSprintById($id)
    {
        $query = (new Db())->getConn()->prepare("SELECT s.id, s.name, s.start_date, s.end_date, s.goal, s.project_id, p.title FROM sprints s JOIN projects p ON s.project_id = p.id WHERE s.id = '$id'");
        $query->execute();

        $sprint = new Sprint();
        while ($sprintData = $query->fetch())
        {
            $sprint->setId($sprintData['id']);
            $sprint->setName($sprintData['name']);
            $start = date_create($sprintData['start_date']);
            $sprint->setStartDate($start);
            $end = date_create($sprintData['end_date']);
            $sprint->setEndDate($end);
            $sprint->setGoal($sprintData['goal']);
            $sprint->setProject($sprintData['project_id']);
            $sprint->setProjectTitle($sprintData['title']);
        }

        return $sprint;
    }


  }
?>