<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Sprint;
use models\Error;

session_start();
if(!isset($_SESSION['current_user_id'])) {
    $error = new Error("Only authorized users can edit sprints.", 401);
    echo json_encode($error);
} else {
    $current_user = $_SESSION['current_user_id'];
    $name = $_POST['name'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$goal = $_POST['goal'];
    $sprint_id = $_GET['id'];

    try {
        Sprint::edit($sprint_id, $name, $start_date, $end_date, $goal);
        header('Location: ./GetSprint.php?id='.$sprint_id);      
    } catch(Exception $ex) {
        $error = new Error("Error! Sprint was not updated.");
        echo json_encode($error);
    }
}
?> 