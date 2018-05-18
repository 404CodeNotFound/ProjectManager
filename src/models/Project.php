<?php
namespace models;
use libs\Db;
class Project
{
    private $id;
    private $title;
    private $start_date;
    private $end_date;
    private $overview;
    private $owner_id;
    private $owner_name;
    private $participants;
    private $is_active;    
    
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

    public function setTitle($title)
    {    
        $this->title = $title;
    }

    public function getTitle()
    {    
        return $this->title;
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

    public function setOverview($overview)
    {    
		$this->overview = $overview;
    }

    public function getOverview()
    {    
		return $this->overview;
    }

    public function setOwner($owner_id)
    {    
		$this->owner_id = $owner_id;
    }

    public function getOwner()
    {    
		return $this->owner_id;
    }

    public function setOwnerName($owner_name)
    {    
		$this->owner_name = $owner_name;
    }

    public function getOwnerName()
    {    
		return $this->owner_name;
    }

    public function setIsActive()
    {    
        $current_date = date("Y/m/d");
		$this->is_active = $this->start_date <= $current_date || $current_date <= $this->end_date;
    }

    public function getIsActive()
    {    
		return $this->is_active;
    }

    public function insert()
    {
        $query = (new Db())->getConn()->prepare("INSERT INTO `projects` (title, start_date, end_date, overview, owner_id, is_active) VALUES (?, ?, ?, ?, ?, ?) ");
        return $query->execute([$this->title, $this->start_date, $this->end_date, $this->overview, $this->owner_id, $this->is_active]);
    }

    public static function getProjectIdByTitle($title)
    {
        $query = (new Db())->getConn()->prepare("SELECT * FROM projects WHERE title = '$title'");
        $query->execute();

        while ($found_project = $query->fetch())
        {
            return $found_project['id'];
        }
    }

    public static function getProjectById($id)
    {
        $query = (new Db())->getConn()->prepare("SELECT p.id, p.title, p.start_date, p.end_date, p.overview, u.full_name FROM projects p JOIN users u ON p.owner_id = u.id WHERE p.id = '$id'");
        $query->execute();

        $project = new Project();
        while ($found_project = $query->fetch())
        {
            $project->setId($found_project['id']);
            $project->setTitle($found_project['title']);
            $start = date_create($found_project['start_date']);
            $project->setStartDate($start);
            $end = date_create($found_project['end_date']);
            $project->setEndDate($end);
            $project->setOverview($found_project['overview']); 
            $project->setOwnerName($found_project['full_name']);
            $project->setIsActive();
        }

        return $project;
    }

    public static function edit($id, $title, $start_date, $end_date, $overview)
    {
        $query = (new Db())->getConn()->prepare("UPDATE projects SET title=?, start_date=?, end_date=?, overview=? WHERE id=?");
        return $query->execute([$title, $start_date, $end_date, $overview, $id]);
    }

    public static function getAll()
    {
        $query = (new Db())->getConn()->prepare("SELECT * FROM projects ORDER BY title");
        $query->execute();

        $projects = [];
        while ($found_project = $query->fetch())
        {
            $project = new Project();
            $project->setTitle($found_project['title']); 
            $project->setId($found_project['id']);
            $projects[] = $project;
        }

        return $projects;
    }
  }
?>