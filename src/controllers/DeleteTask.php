<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Task;
use models\ProjectParticipant;
use models\Error;

session_start();
// Проверка дали потребителят е вписанл
// Само вписани потребители могат да добавят друг потребител към дадена задача.
// Ако потребителят не е вписан, бива пренасочен към страница с подходяща грешка.
if(!isset($_SESSION['current_user_id'])) {
    $error = new Error("Only authorized users can delete a task.", 401);
    echo json_encode($error);
} else {
    // Взимане на id на задачата, която потребителят желае да изтрие от query параметрите на url-а
    $task_id = $_GET['id'];

    // Търсене на задача по даденото id
    $task = Task::getTaskById($task_id);

    // Ако задача с даденото id не съществува, 
    // контролерът връща страница с подходяща грешка и статус 404 (Not found)
    if(!$task->getId()) {
        http_response_code(404);
        header('Location: ../views/Error.php?message=Task was not found.&status_code=404');
    }

    // Проверка дали текущият потребител е участник в проекта, на който принадлежи намерената задача
    $projectParticipants = ProjectParticipant::getAllParticipantsOfProject($task->getProject());
    $isPojectParticipant = false;
    foreach ($projectParticipants as $participant) {
        if($participant->getId() === $current_user_id) {
            $isPojectParticipant = true;
            break;
        }
    }

    // Ако потребителят не е участник в проекта,
    // контролерът връща страница с подходяща грешка и статус 403 (Forbidden)
    if(!$isPojectParticipant) {
        http_response_code(403);
        header('Location: ../views/Error.php?message=Only participants of project can delete this task.&status_code=403');
    }

    try {
        // Изтриване на задачата с даденото id,
        // използвайки метода delete на модела Task
        Task::delete($task_id);

        // Ако изтриването е било успешно,
        // потребителят е пренасочен към страницата на спринта,
        // част от който е дадената задача
        header('Location: ./GetSprint.php?id='.$task->getSprint());
    } catch(Exception $ex) {
        // Ако изтриването не е било успешно, връщаме грешка
        $error = new Error("Error! Task was not updated.");
        echo json_encode($error);
    }
}
?> 