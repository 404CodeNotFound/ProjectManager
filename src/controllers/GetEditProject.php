<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Project;
use models\ProjectParticipant;
use models\User;
use models\Error;

session_start();
if(!isset($_SESSION['current_user_id'])) {
    http_response_code(401);
 	header('Location: ../views/Error.php?message=Only authenticated users can edit projects.&status_code=401');
} else {
    $current_user = $_SESSION['current_user_id'];
    $user_active_sprints = User::getAllActiveSprints($current_user);
    
    $project_id = $_GET['id'];
    $project = Project::getProjectById($project_id);

    if(!$project->getTitle()) {
        http_response_code(404);
        header('Location: ../views/Error.php?message=Project was not found.&status_code=404');
    } else if($project->getOwner() !== $current_user) {
        http_response_code(403);
        header('Location: ../views/Error.php?message=Only the owner of project can edit it.&status_code=403');
    } else {
    	require_once('../views/EditProjectView.php');
    }
}
?>