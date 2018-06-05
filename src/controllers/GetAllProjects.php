<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Project;
use models\User;

session_start();
if(!isset($_SESSION['current_user_id']))
{
    http_response_code(401);
	header('Location: ../views/HomePageView.php');
}
else
{
	$current_user = $_SESSION['current_user_id'];
    $user_active_sprints = User::getAllActiveSprints($current_user);
	
	$projects = Project::getAll($current_user);

	require_once('../views/ProjectsListView.php');
}
?>