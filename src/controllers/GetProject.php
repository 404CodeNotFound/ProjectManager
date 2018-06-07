<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Project;
use models\ProjectParticipant;
use models\Sprint;
use models\User;
use models\Error;

session_start();
if(!isset($_SESSION['current_user_id']))
{
    http_response_code(401);
 	header('Location: ../views/Error.php?message=Only authenticated users can view project details.&status_code=401');
}
else
{
	$current_user = $_SESSION['current_user_id'];
	$user_active_sprints = User::getAllActiveSprints($current_user);
	
	$project_id = $_GET['project_id'];
	$project = Project::getProjectById($project_id);
	if($project->getTitle()) {
		$end_date = $project->getEndDate();
		$current_date = date_create(date('Y-m-d'));

		$remains = date_diff($end_date, $current_date);

		$participants = ProjectParticipant::getAllParticipantsOfProject($project_id);
		$sprints = Sprint::getAllSprintsOfProject($project_id);

		$isParticipantOfProject = false;
		foreach ($participants as $participant) {
			if($participant->getId() === $current_user)
			{
				$isParticipantOfProject = true;
				break;
			}
		}

		if($isParticipantOfProject)
		{
			require_once('../views/ProjectDetailsView.php');	
		}
		else
		{
			http_response_code(403);
 			header('Location: ../views/Error.php?message=Only participants of project can view details.&status_code=403');
		}
	} 
	else
	{
		http_response_code(404);
 		header('Location: ../views/Error.php?message=Project was not found.&status_code=404');
	}
}
?>