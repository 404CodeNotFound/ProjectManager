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

    public function setIsActive()
    {    
        $current_date = date("Y/m/d");
		$this->is_active =  $current_date <= $this->end_date && $this->start_date <= $current_date ? true : false;
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
  }
?>