<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Project;
use models\ProjectParticipant;
use models\Sprint;

$project_id = $_GET['project_id'];
$project = Project::getProjectById($project_id);
$end_date = $project->getEndDate();
$current_date = date_create(date('Y-m-d'));

$remains = date_diff($end_date, $current_date);

$participants = ProjectParticipant::getAllParticipantsOfProject($project_id);
$sprints = Sprint::getAllSprintsOfProject($project_id);

require_once('../views/ProjectDetailsView.php');
?>