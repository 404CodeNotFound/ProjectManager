<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Sprint;
use models\Task;
use models\Project;
use models\ProjectParticipant;
use models\User;
use models\Error;

session_start();
if(!isset($_SESSION['current_user_id'])) {
    http_response_code(401);
    header('Location: ../views/Error.php?message=Only authenticated users can view sprint details.&status_code=401');
} else {
    $current_user_id = $_SESSION['current_user_id'];
    $user_active_sprints = User::getAllActiveSprints($current_user_id);

    $sprint_id = $_GET['id'];
    $sprint = Sprint::getSprintById($sprint_id);

    $all_tasks = Task::getAllSprintTasks($sprint_id);
    $to_do_tasks = array_filter($all_tasks, function($value, $key) {
        return $value->getStatus() === "To-do";
    }, ARRAY_FILTER_USE_BOTH);

    $in_progress_tasks = array_filter($all_tasks, function($value, $key) {
        return $value->getStatus() === "In progress";
    }, ARRAY_FILTER_USE_BOTH);

    $done_tasks = array_filter($all_tasks, function($value, $key) {
        return $value->getStatus() === "Done";
    }, ARRAY_FILTER_USE_BOTH);

    $projectParticipants = ProjectParticipant::getAllParticipantsOfProject($sprint->getProject());
    $isPojectParticipant = false;
    foreach ($projectParticipants as $participant) {
        if($participant->getId() === $current_user_id) {
            $isPojectParticipant = true;
            break;
        }
    }

    if($isPojectParticipant) {
        require_once('../views/SprintDetailsView.php');
    } else {
        http_response_code(403);
        header('Location: ../views/Error.php?message=Only participants of project can view this sprint.&status_code=403');
    }
}
?>