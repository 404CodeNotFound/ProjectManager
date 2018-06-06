<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Sprint;
use models\User;
use models\Error;

session_start();
if(!isset($_SESSION['current_user_id']))
{
    http_response_code(401);
 	header('Location: ../views/Error.php?message=Only authenticated users can edit projects.&status_code=401');
}
else
{
    $current_user = $_SESSION['current_user_id'];
    $user_active_sprints = User::getAllActiveSprints($current_user);
    
    $sprint_id = $_GET['id'];
    $sprint = Sprint::getSprintById($sprint_id);

    if(!$sprint->getName())
    {
        http_response_code(404);
        header('Location: ../views/Error.php?message=Sprint was not found.&status_code=404');
    }
    else
    {
    	require_once('../views/EditSprintView.php');
    }
}
?>