<?php
require_once "../libs/Startup.php";
Startup::_init(true);

session_start();
if(isset($_SESSION['current_user_id']))
{
 	header('Location: ../views/AddProjectView.php');
}
else
{
    header('Location: ../views/Error.php?message=Only authenticated users can add project&status_code=401');
}
?>