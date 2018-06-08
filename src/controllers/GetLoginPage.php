<?php
require_once "../libs/Startup.php";
Startup::_init(true);

session_start();
if(isset($_SESSION['current_user_id']))
{
 	header('Location: ./GetHomePage.php');
}
else
{
    require_once('../views/LoginView.php');
}
?>