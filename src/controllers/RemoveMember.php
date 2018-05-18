<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\User;
use models\ProjectParticipant;
use models\Project;
use models\Error;

$project_id = $_GET['project_id'];
$username = file_get_contents('php://input');

$project = Project::getProjectById($project_id);
if(!$project->getId())
{
	$error = new Error("Project was not found.");
	echo json_encode($error);
}
else 
{
	$user = User::getUserByUsername($username);
	if(!$user->getId())
	{
		$error = new Error("Selected user was not found.");
		echo json_encode($error);
	}
	else 
	{
		$isSuccessful = ProjectParticipant::removeMember($project_id, $user->getId());
		if($isSuccessful)
		{
			echo $isSuccessful;
		}
		else
		{
			$error = new Error("Cannot remove user from this project.");
			echo json_encode($error);
		}
	}
}
?>