<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\User;

session_start();
if(isset($_SESSION['current_user_id'])) {
    $current_user_id = $_SESSION['current_user_id'];
    $user_active_sprints = User::getAllActiveSprints($current_user_id);
    
 	require_once('../views/AddProjectView.php');
} else {
    header('Location: ../views/Error.php?message=Only authenticated users can add project&status_code=401');
}
?>