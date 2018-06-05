<?php
namespace models;
use libs\Db;
use \Datetime;
use \DateInterval;

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

    public function getIsActive()
    {    
		$current_date = date_create(date("Y-m-d"));
        $current_start_dates_diff = (int)date_diff($this->start_date, $current_date)->format("%r%a");
        $current_end_dates_diff = (int)date_diff($current_date, $this->end_date)->format("%r%a");

        if($current_start_dates_diff >= 0 && $current_end_dates_diff >= 0)
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
        $query = (new Db())->getConn()->prepare("INSERT INTO `projects` (title, start_date, end_date, overview, owner_id) VALUES (?, ?, ?, ?, ?) ");
        return $query->execute([$this->title, $this->start_date, $this->end_date, $this->overview, $this->owner_id]);
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
        $query = (new Db())->getConn()->prepare("SELECT p.id, p.title, p.start_date, p.end_date, p.overview, u.full_name, p.owner_id FROM projects p JOIN users u ON p.owner_id = u.id WHERE p.id = '$id'");
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
            $project->setOwner($found_project['owner_id']);
            $project->setOwnerName($found_project['full_name']);
        }

        return $project;
    }

    public static function edit($id, $title, $start_date, $end_date, $overview)
    {
        $query = (new Db())->getConn()->prepare("UPDATE projects SET title=?, start_date=?, end_date=?, overview=? WHERE id=?");
        return $query->execute([$title, $start_date, $end_date, $overview, $id]);
    }

    public static function getAll($user_id)
    {
        $query = (new Db())->getConn()->prepare("SELECT id, title FROM projects p JOIN project_participants participants ON p.id = participants.project_id WHERE participants.user_id = '$user_id' ORDER BY title");
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