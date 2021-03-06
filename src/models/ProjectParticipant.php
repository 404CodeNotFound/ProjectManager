<?php
namespace models;
use libs\Db;
use models\User;

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

    public static function getAllParticipantsOfProject($project_id)
    {
        $query = (new Db())->getConn()->prepare("SELECT u.full_name, u.id FROM project_participants p JOIN users u ON p.user_id = u.id WHERE p.project_id = '$project_id'");
        $query->execute();

        $participants = [];
        while ($found_participant = $query->fetch())
        {
            $user = new User();            
            $user->setFullName($found_participant["full_name"]);
            $user->setId($found_participant["id"]);            
            $participants[] = $user;
        }

        return $participants;
    }

    public static function findParticipantOfProject($user_id, $project_id)
    {
        $query = (new Db())->getConn()->prepare("SELECT u.full_name, u.id FROM project_participants p JOIN users u ON p.user_id = u.id WHERE p.project_id = '$project_id' AND p.user_id = '$user_id'");
        $query->execute();

        $user = new User();            
        while ($found_participant = $query->fetch())
        {
            $user->setId($found_participant["id"]);            
        }

        return $user;
    }

    public function getParticipantsByUsernamePattern($project_id, $pattern) {
        $query = (new Db())->getConn()->prepare("SELECT u.id, u.username FROM users u JOIN project_participants p ON u.id = p.user_id
            WHERE p.project_id = '$project_id' AND u.username LIKE '$pattern%'");
        $query->execute();
        
        $found_participants = [];
        while ($participant = $query->fetch())
        {
            $user = new User();
            $user->setUsername($participant['username']);
            $user->setId($participant['id']);
            $found_participants[] = $user;
        }

        return $found_participants;
    }

    public static function removeMember($project_id, $user_id) 
    {
        $query = (new Db())->getConn()->prepare("DELETE FROM `project_participants` WHERE project_id='$project_id' AND user_id='$user_id'");
        return $query->execute();
    }
  }
?>