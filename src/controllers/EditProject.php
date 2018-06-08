<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use helpers\Validator;
use models\Project;
use models\Error;

session_start();
if(!isset($_SESSION['current_user_id']))
{
    $error = new Error("Only authorized users can create new project.", 401);
    echo json_encode($error);
}
else
{
    $current_user = $_SESSION['current_user_id'];
    $title = $_POST['title'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$overview = $_POST['overview'];
    $id = $_GET['id'];

    $is_title_valid = Validator::exists($title);
    $is_start_date_valid = Validator::exists($start_date);
    $is_end_date_valid = Validator::exists($end_date);
    $is_overview_valid = Validator::exists($overview);
    
    if(!($is_title_valid && $is_start_date_valid && $is_end_date_valid && $is_overview_valid)) 
    {
        header('Location: ../views/EditProjectView.php?title=' . json_encode($is_title_valid) . '&start_date=' . json_encode($is_start_date_valid) . '&end_date=' . json_encode($is_end_date_valid) . '&overview=' . json_encode($is_overview_valid));
    }
    else 
    {
        $isSuccessful = Project::edit($id, $title, $start_date, $end_date, $overview);

        if ($isSuccessful) {
            header('Location: ./GetProject.php?project_id='.$id);
        } else {
            $error = new Error("Error! Project was not updated.");
            echo json_encode($error);
        }
    }
}
?> 