<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Sprint;
use models\Project;
use models\ProjectParticipant;
use models\User;
use models\Error;

session_start();
if(!isset($_SESSION['current_user_id']))
{
    http_response_code(401);
    header('Location: ../views/HomePageView.php');
}
else
{
    $current_user_id = $_SESSION['current_user_id'];
    $user_active_sprints = User::getAllActiveSprints($current_user_id);

    $sprint_id = $_GET['id'];
    $sprint = Sprint::getSprintById($sprint_id);

    // $tasks

    $projectParticipants = ProjectParticipant::getAllParticipantsOfProject($sprint->getProject());
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
        require_once('../views/SprintDetailsView.php');
    }
    else
    {
        $error = new Error("You cannot view this sprint. You are not part of the project team.");
        echo json_encode($error);
    }
}
?>