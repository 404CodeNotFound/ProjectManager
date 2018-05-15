<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\User;
use models\ProjectParticipant;

$project_id = $_GET['project_id'];
$username = file_get_contents('php://input');
echo $username;

$user = User::getUserByUsername($username);
$isSuccessful = ProjectParticipant::removeMember($project_id, $user->getId());
echo $isSuccessful;
?>