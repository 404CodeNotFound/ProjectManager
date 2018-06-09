<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Task;
use models\Error;

session_start();
if(!isset($_SESSION['current_user_id'])) {
    $error = new Error("Only authorized users can create new task.", 401);
    echo json_encode($error);
} else {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $title = $data['title'];
    $description = $data['description'];
    $priority = $data['priority'];
    $story_points = $data['story_points'];
    $sprint_id = $data['sprint_id'];

    $task = Task::create($title, $description, $priority, $story_points, $sprint_id, null, null);
    
    try {
        $isSuccessful = $task->insert();

        echo $isSuccessful;
    } catch (Exception $ex) {
        $e = new Error("Server error.", 500);
        echo json_encode($e);
    }
}
?>