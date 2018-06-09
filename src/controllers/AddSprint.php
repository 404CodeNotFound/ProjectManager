<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use helpers\Validator;
use models\Sprint;
use models\Error;

session_start();
if(!isset($_SESSION['current_user_id'])) {
    $error = new Error("Only authorized users can create new project.", 401);
    echo json_encode($error);
} else {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $name = $data['name'];
    $start_date = $data['start_date'];
    $end_date = $data['end_date'];
    $goal = $data['goal'];
    $project = $data['project_id'];

    $sprint = Sprint::create($name, $start_date, $end_date, $goal, $project);
    
    try {
        $isSuccessful = $sprint->insert();
        echo $isSuccessful;
    } catch (Exception $ex) {
        $e = new Error("Server error.", 500);
        echo json_encode($e);
    }
}
?>