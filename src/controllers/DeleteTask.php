<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Task;
use models\ProjectParticipant;
use models\Error;

session_start();
if(!isset($_SESSION['current_user_id'])) {
    $error = new Error("Only authorized users can delete a task.", 401);
    echo json_encode($error);
} else {
    $task_id = $_GET['id'];
    $task = Task::getTaskById($task_id);

    if(!$task->getId()) {
        http_response_code(404);
        header('Location: ../views/Error.php?message=Task was not found.&status_code=404');
    }

    $projectParticipants = ProjectParticipant::getAllParticipantsOfProject($task->getProject());
    $isPojectParticipant = false;
    foreach ($projectParticipants as $participant) {
        if($participant->getId() === $current_user_id) {
            $isPojectParticipant = true;
            break;
        }
    }

    if(!$isPojectParticipant) {
        http_response_code(403);
        header('Location: ../views/Error.php?message=Only participants of project can delete this task.&status_code=403');
    }

    try {
        Task::delete($task_id);
        header('Location: ./GetSprint.php?id='.$task->getSprint());
    } catch(Exception $ex) {
        $error = new Error("Error! Task was not updated.");
        echo json_encode($error);
    }
}
?> 