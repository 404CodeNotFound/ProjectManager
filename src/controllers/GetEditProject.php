<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Project;
use models\ProjectParticipant;
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
    $project_id = $_GET['id'];
    $project = Project::getProjectById($project_id);

    if(!$project->getTitle())
    {
    	$error = new Error("Error! Project was not found.");
        echo json_encode($error);
    }
    else if($project->getOwner() !== $current_user)
    {
        $error = new Error("Only the owner of project can edit it.");
        echo json_encode($error);
    }
    else
    {
    	require_once('../views/EditProjectView.php');
    }
}
?>