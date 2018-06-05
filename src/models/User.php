<?php
namespace models;
use libs\Db;
class User implements \JsonSerializable
{
    private $id;
    private $username;
    private $password;
    private $email;
    private $full_name;
    
    public function __construct() {

    }

    public static function create($username, $password, $email, $full_name)
    {
        $instance = new self();
        $instance->setUsername($username);
        $instance->setPassword($password);
		$instance->setEmail($email);
        $instance->setFullName($full_name);      
        
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

    public function setUsername($username)
    {    
        $this->username = $username;
    }

    public function getUsername()
    {    
        return $this->username;
    }

    public function setPassword($password)
    {    
        $this->password = $password;
    }

    public function getPassword()
    {    
        return $this->password;
    }

    public function setEmail($email)
    {    
        $this->email = $email;
    }

    public function getEmail()
    {    
        return $this->email;
    }

    public function setFullName($full_name)
    {    
		$this->full_name = $full_name;
    }

    public function getFullName()
    {    
		return $this->full_name;
    }

    public function insert()
    {
        $query = (new Db())->getConn()->prepare("INSERT INTO `users` (username, password, email, full_name) VALUES (?, ?, ?, ?) ");
        return $query->execute([$this->username, $this->password, $this->email, $this->full_name]);
    }

    public function getUser($username, $password)
    {
        $query = (new Db())->getConn()->prepare("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
        $query->execute();
        
        $user = new User();
        
        while ($foundUser = $query->fetch())
        {
            $user->setUsername($foundUser['username']);
            $user->setId($foundUser['id']);
        }
        
        return $user;
    }

    public function getUserByUsername($username)
    {
        $query = (new Db())->getConn()->prepare("SELECT * FROM users WHERE username = '$username'");
        $query->execute();
        
        $user = new User();

        while ($found_user = $query->fetch())
        {
            $user->setUsername($found_user['username']);
            $user->setFullName($found_user['full_name']);
            $user->setId($found_user['id']);
        }

        return $user;
    }

    public function getUsersByUsernamePattern($username_pattern) {
        $query = (new Db())->getConn()->prepare("SELECT * FROM users WHERE username LIKE '$username_pattern%'");
        $query->execute();
        
        $found_users = array();

        while ($found_user = $query->fetch())
        {
            $user = new User();
            $user->setUsername($found_user['username']);
            $user->setId($found_user['id']);
            array_push($found_users, $user);
        }

        return $found_users;
    }

    public static function getAllActiveSprints($user_id)
    {
        $query = (new Db())->getConn()->prepare("SELECT s.id, s.name FROM project_participants pp JOIN projects p ON pp.project_id = p.id JOIN sprints s ON p.id = s.project_id WHERE pp.user_id = '$user_id'");
        $query->execute();

        $active_sprints = [];
        while ($current_sprint = $query->fetch())
        {
            $sprint = new Sprint();
            $sprint->setId($current_sprint['id']);
            $sprint->setName($current_sprint['name']);
            $active_sprints[] = $sprint;
        }

        return $active_sprints;
    }

    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }
  }
?>