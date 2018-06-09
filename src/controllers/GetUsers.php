<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\User;

session_start();
if(!isset($_SESSION['current_user_id'])) {
    http_response_code(401);
	header('Location: ../views/HomePageView.php');
} else {
	$username = htmlspecialchars($_GET["username"]);
	$users = User::getUsersByUsernamePattern($username);
	
	header('Content-Type: application/json');
	echo json_encode($users);
}
?>