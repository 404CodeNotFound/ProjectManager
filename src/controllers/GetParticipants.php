<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\ProjectParticipant;

session_start();
if(!isset($_SESSION['current_user_id']))
{
    http_response_code(401);
	header('Location: ../views/HomePageView.php');
}
else
{
    $project_id = $_GET['project_id'];
    $pattern = htmlspecialchars($_GET['pattern']);
    
    $participants = ProjectParticipant::getParticipantsByUsernamePattern($project_id, $pattern);
    
	header('Content-Type: application/json');
	echo json_encode($participants);
}
?>