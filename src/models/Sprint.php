<?php
namespace models;
use libs\Db;
class Sprint
{
    private $id;
    private $name;
    private $start_date;
    private $end_date;
    private $project_id;   
    
    public function __construct() {

    }

    public static function create($title, $start_date, $end_date, $overview, $owner)
    {
        $instance = new self();
        $instance->setTitle($title);
        $instance->setStartDate($start_date);
		$instance->setEndDate($end_date);
        $instance->setOverview($overview);
        $instance->setOwner($owner);
        $instance->setIsActive();        
        
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

    public function setProjectId($project_id)
    {    
		$this->project_id = $project_id;
    }

    public function getProjectId()
    {    
		return $this->project_id;
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
  }
?>