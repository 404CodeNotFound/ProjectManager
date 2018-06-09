<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\User;
use models\Task;
use models\Error;

session_start();
if(!isset($_SESSION['current_user_id'])) {
	http_send_status(401);
    $error = new Error("Only authorized users can add tasks assignee.", 401);
	echo json_encode($error);
} else {
	$current_user = $_SESSION['current_user_id'];
	$task_id = $_GET['task_id'];
	$user_id = file_get_contents('php://input');

	$task = Task::getTaskById($task_id);
	if(!$task->getId()) {
		$error = new Error("Task was not found.", 404);
		echo json_encode($error);
	} else {
		$user = User::getUserById($user_id);
		if(!$user->getId()) {
			$error = new Error("User was not found.", 404);
			echo json_encode($error);
		} else {
            try {
                Task::setAssignee($task_id, $user->getId());
                echo json_encode($user->getId());
            } catch (Exceprion $ex) {
                $error = new Error("Could not assign user to task.", 500);
                echo json_encode($error);
            }
		}	
	}
}
?>