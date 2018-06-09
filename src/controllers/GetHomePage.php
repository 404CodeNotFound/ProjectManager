<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\User;

session_start();
if(!isset($_SESSION['current_user_id'])) {
 	require_once('../views/HomePageView.php');
} else {
    $current_user = $_SESSION['current_user_id'];
    $user_active_sprints = User::getAllActiveSprints($current_user);
    require_once('../views/HomePageLoggedView.php');
}
?>