<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\User;
use models\ProjectParticipant;
use models\Project;
use models\Error;

session_start();
if(!isset($_SESSION['current_user_id']))
{
    http_response_code(401);
	header('Location: ../views/HomePageView.php');
}
else
{
	$current_user = $_SESSION['current_user_id'];
	$project_id = $_GET['project_id'];
	$username = file_get_contents('php://input');

	$project = Project::getProjectById($project_id);
	if(!$project->getId())
	{
		$error = new Error("Project was not found.");
		echo json_encode($error);
	}
	else if($project->getOwner() !== $current_user)
	{
		$error = new Error("You cannot remove member from project because you are not the owner.");
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
}
?>