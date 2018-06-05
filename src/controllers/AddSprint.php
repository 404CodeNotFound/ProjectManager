<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Sprint;

session_start();
if(!isset($_SESSION['current_user_id']))
{
    http_response_code(401);
    header('Location: ../views/HomePageView.php');
}
else
{
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $name = $data['name'];
    $start_date = $data['start_date'];
    $end_date = $data['end_date'];
    $goal = $data['goal'];
    $project = $data['project_id'];

    $sprint = Sprint::create($name, $start_date, $end_date, $goal, $project);
    $isSuccessful = $sprint->insert();

    if ($isSuccessful) {
        echo $isSuccessful;
    } else {
        echo "<p> Error! The sprint was not inserted! </p>";
    }
}
?>