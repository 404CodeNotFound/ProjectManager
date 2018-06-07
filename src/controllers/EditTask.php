<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Task;
use models\Error;

session_start();
if(!isset($_SESSION['current_user_id']))
{
    $error = new Error("Only authorized users can edit a task.", 401);
    echo json_encode($error);
}
else
{
    $title = $_POST['title'];
	$description = $_POST['description'];
	$priority = $_POST['priority'];
	$story_points = $_POST['story-points'];
    $task_id = $_GET['id'];

    try {
        Task::edit($task_id, $title, $description, $priority, $story_points);
        
        header('Location: ./GetTask.php?id='.$task_id);
    } catch(Exception $ex) {
        $error = new Error("Error! Task was not updated.");
        echo json_encode($error);
    }
}
?> 