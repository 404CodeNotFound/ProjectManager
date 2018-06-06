<?php
namespace models;
class Error implements \JsonSerializable
{
    private $message;
    private $status_code;   
    
    public function __construct($message, $status_code) {
        $this->setMessage($message);
        $this->setStatusCode($status_code);
    }

    public function setMessage($message)
    {    
        $this->message = $message;
    }

    public function getMessage()
    {    
        return $this->message;
    }

    public function setStatusCode($status_code)
    {    
        $this->status_code = $status_code;
    }

    public function getStatusCode()
    {    
        return $this->status_code;
    }


    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }
  }
?>