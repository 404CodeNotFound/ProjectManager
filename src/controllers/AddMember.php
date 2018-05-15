<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\User;
use models\Project;
use models\ProjectParticipant;

$project_id = $_GET['project_id'];
$username = file_get_contents('php://input');

$project = Project::getProjectById($project_id);
if(!$project->getId())
{
	// not found
	echo null;
}
else 
{
	$user = User::getUserByUsername($username);
	if(!$user->getId())
	{
		// not found
		echo null;
	}

	$member = ProjectParticipant::create($project_id, $user->getId());
	$isSuccessful = $member->insert();
	if($isSuccessful)
	{
		echo $user->getFullName();
	}
	else
	{
		echo null;
	}
}
?>