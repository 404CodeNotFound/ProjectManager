<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\User;

session_start();
if(!isset($_SESSION['current_user_id'])) {
    http_response_code(401);
 	header('Location: ../views/Error.php?message=Only authenticated users can create tasks.&status_code=401');
} else {
    $current_user_id = $_SESSION['current_user_id'];
    $user_active_sprints = User::getAllActiveSprints($current_user_id);
    
    $sprint_id = $_GET['sprint_id'];

    require_once('../views/AddTaskView.php');
}
?>