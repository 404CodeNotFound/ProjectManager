<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Task;
use models\User;
use models\Project;
use models\ProjectParticipant;
use models\Error;

session_start();
if(!isset($_SESSION['current_user_id']))
{
    http_response_code(401);
    header('Location: ../views/Error.php?message=Only authenticated users can view task details.&status_code=401');
}
else
{
    $current_user_id = $_SESSION['current_user_id'];
    $user_active_sprints = User::getAllActiveSprints($current_user_id);

    $task_id = $_GET['id'];
    $task = Task::getTaskById($task_id);
    
    $project_title = Project::getProjectTitleByProjectId($task->getProject());

    $projectParticipants = ProjectParticipant::getAllParticipantsOfProject($task->getProject());
    $isPojectParticipant = false;
    foreach ($projectParticipants as $participant)
    {
        if($participant->getId() === $current_user_id)
        {
            $isPojectParticipant = true;
            break;
        }
    }

    if($isPojectParticipant)
    {
        require_once('../views/TaskDetailsView.php');
    }
    else
    {
        http_response_code(403);
        header('Location: ../views/Error.php?message=Only participants of project can view this task.&status_code=403');
    }
}
?>