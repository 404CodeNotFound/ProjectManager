<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\User;
use models\Task;
use models\Error;

session_start();
if(!isset($_SESSION['current_user_id']))
{
	http_send_status(401);
    $error = new Error("Only authorized users can edit tasks status.", 401);
	echo json_encode($error);
}
else
{
	$current_user = $_SESSION['current_user_id'];
	$task_id = $_GET['task_id'];
	$status = file_get_contents('php://input');

	$task = Task::getTaskById($task_id);
	if(!$task->getId())
	{
		$error = new Error("Task was not found.", 404);
		echo json_encode($error);
	}
	else 
	{
		try
        {
            Task::editStatus($task_id, $status);
            
            echo json_encode($task->getId());
        } 
        catch (Exceprion $ex) 
        {
            $error = new Error("Could not edit task status.", 500);
            echo json_encode($error);
        }
	}
}
?>