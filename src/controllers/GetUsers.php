<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\User;

$username = htmlspecialchars($_GET["username"]);
$users = User::getUsersByUsernamePattern($username);
header('Content-Type: application/json');
echo json_encode($users);
?>