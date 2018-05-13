<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Project;
use models\ProjectParticipant;

session_start();
// if(!isset($_SESSION['current_user_id']))
// {
//     http_response_code(401);
// 	header('Location: ../views/ErrorPage');
// }
// else
// {
    $project_id = $_GET['id'];
    $project = Project::getProjectById($project_id);

    require_once('../views/EditProjectView.php');
//}
?>