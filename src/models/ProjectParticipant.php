<?php
namespace models;
use libs\Db;
class ProjectParticipant
{
    private $project_id;
    private $user_id; 
    
    public function __construct() {

    }

    public static function create($project_id, $user_id)
    {
        $instance = new self();
        $instance->setProjectId($project_id);
        $instance->setUserId($user_id);      
        
        return $instance;
    }

    public function setProjectId($project_id)
    {    
        $this->project_id = $project_id;
    }

    public function getProjectId()
    {    
        return $this->project_id;
    }

    public function setUserId($user_id)
    {    
        $this->user_id = $user_id;
    }

    public function getUserId()
    {    
        return $this->user_id;
    }

    public function insert()
    {
        $query = (new Db())->getConn()->prepare("INSERT INTO `project_participants` (project_id, user_id) VALUES (?, ?)");
        return $query->execute([$this->project_id, $this->user_id]);
    }
  }
?>