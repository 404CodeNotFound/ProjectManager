<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\User;
use models\Sprint;
use models\Task;

session_start();
if(!isset($_SESSION['current_user_id']))
{
    http_response_code(401);
 	header('Location: ../views/Error.php?message=Only authenticated users can view dashboard.&status_code=401');
}
else
{
	$current_user = $_SESSION['current_user_id'];
    $user_active_sprints = User::getAllActiveSprints($current_user);
    
    foreach ($user_active_sprints as $sprint) {
        $tasks = Task::getAllSprintTasks($sprint->getId());

        $sprint->setTasks($tasks);
    }

	require_once('../views/DashboardView.php');
}
?>